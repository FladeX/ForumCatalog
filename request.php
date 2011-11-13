<?php

/* Скрипт поиска по сайту на основе Яндекс.XML.
   php-MyAdmin.ru/learning/search.html 0.6 (utf-8). 28.11.2010
   */

function L_cURL($sPost, $aLocal) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_TIMEOUT,        30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_NOBODY,         false);
    curl_setopt($ch, CURLOPT_HEADER,         false);
    curl_setopt($ch, CURLOPT_INTERFACE,      $aLocal['ip']);
    curl_setopt($ch, CURLOPT_URL,            $aLocal['url']);
    curl_setopt($ch, CURLOPT_POST,           true);
    curl_setopt($ch, CURLOPT_POSTFIELDS,     'text=' . $sPost);
    $file_contents = curl_exec($ch);
    if (curl_error($ch) != '') {
        $file_contents = false;
    }
    curl_close($ch);
    return $file_contents;
}

function L_XML($sContents, $aLocal) {
    $rand = rand();
    $xmlstr = preg_replace('/<hlword[^>]*>([^<]+)<\/hlword>/i',
        '[b_' . $rand . ']$1[/b_' . $rand . ']', $sContents);
    $xml = new SimpleXMLElement($xmlstr);

    if ($xml->response->error) {
        $print = '<error>' . $xml->response->error . '</error>' . "\n";
    } else {
        $found = $xml->response->results->grouping->found[2];
        $print  = '<reqid>' . $xml->response->reqid . '</reqid>' . "\n";
        $print .= '<found>' . $found . '</found>' . "\n";
        $print .= '<found-human>' . $xml->response->{'found-human'} . '</found-human>' . "\n";
        $print .= '<rand>' . $rand . '</rand>' . "\n";
        $print .= '<page>' . $xml->request->page . '</page>' . "\n";

        foreach ($xml->response->results->grouping->group as $group) {
            $print .= '<group>' . "\n";
            $print .= '<url>' . htmlspecialchars($group->doc->url) . '</url>' . "\n";
            $print .= '<title>' . htmlspecialchars($group->doc->title) . '</title>' . "\n";
            $print .= '<passage>' . htmlspecialchars($group->doc->passages->passage) . '</passage>' . "\n";
            $print .= '</group>' . "\n";
        }
    }

    if (isset($print)) print $print;
}

require('./config.php');
header('Content-Type: application/xml');
header('Cache-Control: no-cache');
print '<?xml version="1.0" encoding="utf-8" ?>' . "\n"
    . '<root>';

if (isset($_POST['query'], $_POST['xml_case'])
        && strlen($_POST['query']) > 2 && $_POST['xml_case'] == 'search') {
    $aLocal['page'] = (isset($_POST['page']) && preg_match('/[1-9]\d{0,9}/', $_POST['page']))
        ? $_POST['page'] - 1 : 0;
    $aLocal['query'] = $_POST['query'];
    $aLocal['host_s'] = sprintf('host:%s', $aLocal['host']);
    $sPost = '<?xml version="1.0" encoding="utf-8"?>' . "\n"
           . '<request>' . "\n"
           .   '<query>' . htmlspecialchars($aLocal['query'])
           .     ' &lt;&lt; ' . $aLocal['host_s'] . '</query>' . "\n"
           .   '<groupings>' . "\n"
           .     '<groupby attr="" mode="flat" groups-on-page="10" docs-in-group="1" />' . "\n"
           .   '</groupings>' . "\n"
           .   '<page>' . $aLocal['page'] . '</page>' . "\n"
           . '</request>';
    if ($sContents = L_cURL($sPost, $aLocal)) L_XML($sContents, $aLocal);
;
}

print '</root>';
exit;

?>