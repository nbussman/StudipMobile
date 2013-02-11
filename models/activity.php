<?php
namespace Studip\Mobile;

/**
 *    Activity Class for newest informations
 *    @author Nils Bussmann - nbussman@uos.de
 */
class Activity {

    # TODO args?
    static function findAllByUser($user_id, $seminar_cur=0, $range = null, $days = 365, $category = null)
    {
        $days = \Request::int('days', 365);
        
        return self::get_activities($user_id, $range, $days, $seminar_cur);
    }

    /**
     * Get all activities for this user as an array.
     */
    private function get_activities($user_id, $range, $days, $seminar_cur= 0)
    {
        
        $db = \DBManager::get();
        $now = time();
        $chdate = $now - 24 * 60 * 60 * $days;
        $items = array();
        
        $seminar_add_query = "";
        if ($seminar_cur != 0)
        {
            $seminar_add_query =" AND Seminar_id = '$seminar_cur'";
        }
        echo $seminar_add_query;
        if ($range === 'user') {
            $sem_filter = "seminar_user.user_id = '$user_id' AND auth_user_md5.user_id = '$user_id'";
            $inst_filter = "user_inst.user_id = '$user_id' AND auth_user_md5.user_id = '$user_id'";
        } else if (isset($range)) {
            $sem_filter = "seminar_user.user_id = '$user_id' AND Seminar_id = '$range'";
            $inst_filter = "user_inst.user_id = '$user_id' AND Institut_id = '$range'";
        } else {
            $sem_filter = "seminar_user.user_id = '$user_id'";
            $inst_filter = "user_inst.user_id = '$user_id'";
        }

        $sem_fields = 'auth_user_md5.user_id AS author_id, auth_user_md5.Vorname, auth_user_md5.Nachname, seminare.Name';
        $inst_fields = 'auth_user_md5.user_id AS author_id, auth_user_md5.Vorname, auth_user_md5.Nachname, Institute.Name';
        $user_fields = 'auth_user_md5.user_id AS author_id, auth_user_md5.Vorname, auth_user_md5.Nachname, auth_user_md5.username';

        // forum

        $sql = "SELECT px_topics.*, $sem_fields
                FROM px_topics
                JOIN auth_user_md5 USING (user_id)
                JOIN seminar_user USING (Seminar_id)
                JOIN seminare USING (Seminar_id)
                WHERE $sem_filter AND px_topics.chdate > $chdate $seminar_add_query";

        $result = $db->query($sql);

        foreach ($result as $row) {
            $items[] = array(
                'id' => $row['topic_id'],
                'title' => $row['name'],
                'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                'author_id' => $row['author_id'],
                'link' => \URLHelper::getLink('forum.php#anker',
                    array('cid' => $row['Seminar_id'], 'view' => 'tree', 'open' => $row['topic_id'])),
                'updated' => $row['chdate'],
                'summary' => sprintf('%s %s hat im Forum der Veranstaltung "%s" den Beitrag "%s" geschrieben.',
                    $row['Vorname'], $row['Nachname'], $row['Name'], $row['name']),
                'content' => $row['description'],
                'category' => 'forum'
            );
            // ersetzt, da forum_kill_edit nicht auffindbar, bzw nur vom root nutzbar
            //'content' => forum_kill_edit($row['description']),
        }

        $sql = "SELECT px_topics.*, $inst_fields
                FROM px_topics
                JOIN auth_user_md5 USING (user_id)
                JOIN user_inst ON (Seminar_id = Institut_id)
                JOIN Institute USING (Institut_id)
                WHERE $inst_filter AND px_topics.chdate > $chdate $seminar_add_query";

        $result = $db->query($sql);

        foreach ($result as $row) {
            $items[] = array(
                'id' => $row['topic_id'],
                'title' => $row['name'],
                'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                'author_id' => $row['author_id'],
                'link' => \URLHelper::getLink('forum.php#anker',
                    array('cid' => $row['Institut_id'], 'view' => 'tree', 'open' => $row['topic_id'])),
                'updated' => $row['chdate'],
                'summary' => sprintf('%s %s hat im Forum der Einrichtung "%s" den Beitrag "%s" geschrieben.',
                    $row['Vorname'], $row['Nachname'], $row['Name'], $row['name']),
                'content' => $row['description'],
                'category' => 'forum'
            );
            // ersetzt, da forum_kill_edit nicht auffindbar, bzw nur vom root nutzbar
            //'content' => forum_kill_edit($row['description']),
        }

        // files

        $sql = "SELECT dokumente.*, $sem_fields
                FROM dokumente
                JOIN auth_user_md5 USING (user_id)
                JOIN seminar_user USING (Seminar_id)
                JOIN seminare USING (Seminar_id)
                WHERE $sem_filter AND dokumente.chdate > $chdate $seminar_add_query";

        $result = $db->query($sql);

        foreach ($result as $row) {
            $folder_tree = \TreeAbstract::GetInstance('StudipDocumentTree', array('range_id' => $row['seminar_id']));

            if ($folder_tree->isDownloadFolder($row['range_id'], $user_id)) {
                $items[] = array(
                    'id' => $row['dokument_id'],
                    'title' => $row['name'],
                    'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                    'author_id' => $row['author_id'],
                    'link' => htmlReady("courses/list_files/".$row['seminar_id']),
                    'updated' => $row['chdate'],
                    'summary' => sprintf('%s %s hat im Dateibereich der Veranstaltung "%s" die Datei "%s" hochgeladen.',
                        $row['Vorname'], $row['Nachname'], $row['Name'], $row['name']),
                    'content' => $row['description'] . " (" . $row['filename'] . ")",
                    'category' => 'files'
                );
            }
        }

        $sql = "SELECT dokumente.*, $inst_fields
                FROM dokumente
                JOIN auth_user_md5 USING (user_id)
                JOIN user_inst ON (seminar_id = Institut_id)
                JOIN Institute USING (Institut_id)
                WHERE $inst_filter AND dokumente.chdate > $chdate $seminar_add_query";

        $result = $db->query($sql);

        foreach ($result as $row) {
            $folder_tree = \TreeAbstract::GetInstance('StudipDocumentTree', array('range_id' => $row['seminar_id']));

            if ($folder_tree->isDownloadFolder($row['range_id'], $user_id)) {
                $items[] = array(
                    'id' => $row['dokument_id'],
                    'title' => $row['name'],
                    'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                    'author_id' => $row['author_id'],
                    'link' => \URLHelper::getLink('folder.php#anker',
                        array('cid' => $row['Institut_id'], 'cmd' => 'tree', 'open' => $row['dokument_id'])),
                    'updated' => $row['chdate'],
                    'summary' => sprintf('%s %s hat im Dateibereich der Einrichtung "%s" die Datei "%s" hochgeladen.',
                        $row['Vorname'], $row['Nachname'], $row['Name'], $row['name']),
                    'content' => $row['description'],
                    'category' => 'files'
                );
            }
        }

        // wiki

        $sql = "SELECT wiki.*, $sem_fields
                FROM wiki
                JOIN auth_user_md5 USING (user_id)
                JOIN seminar_user ON (range_id = Seminar_id)
                JOIN seminare USING (Seminar_id)
                WHERE $sem_filter AND wiki.chdate > $chdate $seminar_add_query";

        $result = $db->query($sql);

        foreach ($result as $row) {
            $items[] = array(
                'id' => md5($row['range_id'] . ':' . $row['keyword'] . ':' . $row['version']),
                'title' => $row['keyword'],
                'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                'author_id' => $row['author_id'],
                'link' => \URLHelper::getLink('wiki.php',
                    array('cid' => $row['range_id'], 'keyword' => $row['keyword'])),
                'updated' => $row['chdate'],
                'summary' => sprintf('%s %s hat im Wiki der Veranstaltung "%s" die Seite "%s" geändert.',
                    $row['Vorname'], $row['Nachname'], $row['Name'], $row['keyword']),
                'content' => $row['body'],
                'category' => 'wiki'
            );
        }
        if ($seminar_cur == 0)
        {
            $sql = "SELECT wiki.*, $inst_fields
                    FROM wiki
                    JOIN auth_user_md5 USING (user_id)
                    JOIN user_inst ON (range_id = Institut_id)
                    JOIN Institute USING (Institut_id)
                    WHERE $inst_filter AND wiki.chdate > $chdate ";

            $result = $db->query($sql);

            foreach ($result as $row) {
                $items[] = array(
                    'id' => md5($row['range_id'] . ':' . $row['keyword'] . ':' . $row['version']),
                    'title' => $row['keyword'],
                    'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                    'author_id' => $row['author_id'],
                    'link' => \URLHelper::getLink('wiki.php',
                        array('cid' => $row['range_id'], 'keyword' => $row['keyword'])),
                    'updated' => $row['chdate'],
                    'summary' => sprintf('%s %s hat im Wiki der Einrichtung "%s" die Seite "%s" geändert.',
                        $row['Vorname'], $row['Nachname'], $row['Name'], $row['keyword']),
                    'content' => $row['body'],
                    'category' => 'wiki'
                );
            }
        }

        // info

        $sql = "SELECT scm.*, $sem_fields
                FROM scm
                JOIN auth_user_md5 USING (user_id)
                JOIN seminar_user ON (range_id = Seminar_id)
                JOIN seminare USING (Seminar_id)
                WHERE $sem_filter AND scm.chdate > $chdate $seminar_add_query";

        $result = $db->query($sql);

        foreach ($result as $row) {
            $items[] = array(
                'id' => $row['scm_id'],
                'title' => $row['tab_name'],
                'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                'author_id' => $row['author_id'],
                'link' => \URLHelper::getLink('scm.php',
                    array('cid' => $row['range_id'], 'show_scm' => $row['scm_id'])),
                'updated' => $row['chdate'],
                'summary' => sprintf('%s %s hat in der Veranstaltung "%s" die Informationsseite "%s" geändert.',
                    $row['Vorname'], $row['Nachname'], $row['Name'], $row['tab_name']),
                'content' => $row['content'],
                'category' => 'info'
            );
        }
        if ($seminar_cur == 0)
        {
            $sql = "SELECT scm.*, $inst_fields
                    FROM scm
                    JOIN auth_user_md5 USING (user_id)
                    JOIN user_inst ON (range_id = Institut_id)
                    JOIN Institute USING (Institut_id)
                    WHERE $inst_filter AND scm.chdate > $chdate";

            $result = $db->query($sql);

            foreach ($result as $row) {
                $items[] = array(
                    'id' => $row['scm_id'],
                    'title' => $row['tab_name'],
                    'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                    'author_id' => $row['author_id'],
                    'link' => \URLHelper::getLink('scm.php',
                        array('cid' => $row['range_id'], 'show_scm' => $row['scm_id'])),
                    'updated' => $row['chdate'],
                    'summary' => sprintf('%s %s hat in der Einrichtung "%s" die Informationsseite "%s" geändert.',
                        $row['Vorname'], $row['Nachname'], $row['Name'], $row['tab_name']),
                    'content' => $row['content'],
                    'category' => 'info'
                );
            }
        }

        // news
        
        if (($seminar_cur == 0) && ($range === 'user')) {
            $sql = "SELECT news.*, news_range.range_id, $user_fields
                    FROM news
                    JOIN news_range USING (news_id)
                    JOIN auth_user_md5 USING (user_id)
                    WHERE range_id = '$user_id' AND news.date BETWEEN $chdate AND $now";

            $result = $db->query($sql);

            foreach ($result as $row) {
                $items[] = array(
                    'id' => $row['news_id'],
                    'title' => $row['topic'],
                    'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                    'author_id' => $row['author_id'],
                    'link' => \URLHelper::getLink('about.php#anker',
                        array('username' => $row['username'], 'nopen' => $row['news_id'])),
                    'updated' => max($row['date'], $row['chdate']),
                    'summary' => sprintf('%s %s hat die persönliche Ankündigung "%s" eingestellt.',
                        $row['Vorname'], $row['Nachname'], $row['topic']),
                    'content' => $row['body'],
                    'category' => 'news'
                );
            }
        }

        $sql = "SELECT news.*, news_range.range_id, $sem_fields
                FROM news
                JOIN news_range USING (news_id)
                JOIN auth_user_md5 USING (user_id)
                JOIN seminar_user ON (range_id = Seminar_id)
                JOIN seminare USING (Seminar_id)
                WHERE $sem_filter AND news.date BETWEEN $chdate AND $now $seminar_add_query";

        $result = $db->query($sql);

        foreach ($result as $row) {
            $items[] = array(
                'id' => $row['news_id'],
                'title' => $row['topic'],
                'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                'author_id' => $row['author_id'],
                'link' => \URLHelper::getLink('seminar_main.php#anker',
                    array('cid' => $row['range_id'], 'nopen' => $row['news_id'])),
                'updated' => max($row['date'], $row['chdate']),
                'summary' => sprintf('%s %s hat in der Veranstaltung "%s" die Ankündigung "%s" eingestellt.',
                    $row['Vorname'], $row['Nachname'], $row['Name'], $row['topic']),
                'content' => $row['body'],
                'category' => 'news'
            );
        }
        
        if ($seminar_cur == 0)
        {
            $sql = "SELECT news.*, news_range.range_id, $inst_fields
                    FROM news
                    JOIN news_range USING (news_id)
                    JOIN auth_user_md5 USING (user_id)
                    JOIN user_inst ON (range_id = Institut_id)
                    JOIN Institute USING (Institut_id)
                    WHERE $inst_filter AND news.date BETWEEN $chdate AND $now";

            $result = $db->query($sql);

            foreach ($result as $row) {
                $items[] = array(
                    'id' => $row['news_id'],
                    'title' => $row['topic'],
                    'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                    'author_id' => $row['author_id'],
                    'link' => \URLHelper::getLink('institut_main.php#anker',
                        array('cid' => $row['range_id'], 'nopen' => $row['news_id'])),
                    'updated' => max($row['date'], $row['chdate']),
                    'summary' => sprintf('%s %s hat in der Einrichtung "%s" die Ankündigung "%s" eingestellt.',
                        $row['Vorname'], $row['Nachname'], $row['Name'], $row['topic']),
                    'content' => $row['body'],
                    'category' => 'news'
                );
            }
        

            // votings

            if ($range === 'user') {
                $sql = "SELECT vote.*, $user_fields
                        FROM vote
                        JOIN auth_user_md5 ON (author_id = user_id)
                        WHERE range_id = '$user_id' AND vote.startdate BETWEEN $chdate AND $now";

                $result = $db->query($sql);

                foreach ($result as $row) {
                    $items[] = array(
                        'id' => $row['vote_id'],
                        'title' => $row['title'],
                        'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                        'author_id' => $row['author_id'],
                        'link' => \URLHelper::getLink('about.php#openvote',
                            array('username' => $row['username'], 'voteopenID' => $row['vote_id'])),
                        'updated' => max($row['startdate'], $row['chdate']),
                        'summary' => sprintf('%s %s hat die persönliche Umfrage "%s" gestartet.',
                            $row['Vorname'], $row['Nachname'], $row['title']),
                        'content' => $row['question'],
                        'category' => 'votings'
                    );
                }
            }
        }
        $sql = "SELECT vote.*, $sem_fields
                FROM vote
                JOIN auth_user_md5 ON (author_id = user_id)
                JOIN seminar_user ON (range_id = Seminar_id)
                JOIN seminare USING (Seminar_id)
                WHERE $sem_filter AND vote.startdate BETWEEN $chdate AND $now $seminar_add_query";

        $result = $db->query($sql);

        foreach ($result as $row) {
            $items[] = array(
                'id' => $row['vote_id'],
                'title' => $row['title'],
                'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                'author_id' => $row['author_id'],
                'link' => \URLHelper::getLink('seminar_main.php#openvote',
                    array('cid' => $row['range_id'], 'voteopenID' => $row['vote_id'])),
                'updated' => max($row['startdate'], $row['chdate']),
                'summary' => sprintf('%s %s hat in der Veranstaltung "%s" die Umfrage "%s" gestartet.',
                    $row['Vorname'], $row['Nachname'], $row['Name'], $row['title']),
                'content' => $row['question'],
                'category' => 'votings'
            );
        }

        if ($seminar_cur == 0)
        {
            $sql = "SELECT vote.*, $inst_fields
                    FROM vote
                    JOIN auth_user_md5 ON (author_id = user_id)
                    JOIN user_inst ON (range_id = Institut_id)
                    JOIN Institute USING (Institut_id)
                    WHERE $inst_filter AND vote.startdate BETWEEN $chdate AND $now";

            $result = $db->query($sql);

            foreach ($result as $row) {
                $items[] = array(
                    'id' => $row['vote_id'],
                    'title' => $row['title'],
                    'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                    'author_id' => $row['author_id'],
                    'link' => \URLHelper::getLink('institut_main.php#openvote',
                        array('cid' => $row['range_id'], 'voteopenID' => $row['vote_id'])),
                    'updated' => max($row['startdate'], $row['chdate']),
                    'summary' => sprintf('%s %s hat in der Einrichtung "%s" die Umfrage "%s" gestartet.',
                        $row['Vorname'], $row['Nachname'], $row['Name'], $row['title']),
                    'content' => $row['question'],
                    'category' => 'votings'
                );
            }

            // surveys

            if ($range === 'user') {
                $sql = "SELECT eval.*, $user_fields
                        FROM eval
                        JOIN eval_range USING (eval_id)
                        JOIN auth_user_md5 ON (author_id = user_id)
                        WHERE range_id = '$user_id' AND eval.startdate BETWEEN $chdate AND $now";

                $result = $db->query($sql);

                foreach ($result as $row) {
                    $items[] = array(
                        'id' => $row['eval_id'],
                        'title' => $row['title'],
                        'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                        'author_id' => $row['author_id'],
                        'link' => \URLHelper::getLink('about.php#openvote',
                            array('username' => $row['username'], 'voteopenID' => $row['eval_id'])),
                        'updated' => max($row['startdate'], $row['chdate']),
                        'summary' => sprintf('%s %s hat die persönliche Evaluation "%s" gestartet.',
                            $row['Vorname'], $row['Nachname'], $row['title']),
                        'content' => $row['text'],
                        'category' => 'surveys'
                    );
                }
            }
        }
        $sql = "SELECT eval.*, $sem_fields
                FROM eval
                JOIN eval_range USING (eval_id)
                JOIN auth_user_md5 ON (author_id = user_id)
                JOIN seminar_user ON (range_id = Seminar_id)
                JOIN seminare USING (Seminar_id)
                WHERE $sem_filter AND eval.startdate BETWEEN $chdate AND $now $seminar_add_query";

        $result = $db->query($sql);

        foreach ($result as $row) {
            $items[] = array(
                'id' => $row['eval_id'],
                'title' => $row['title'],
                'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                'author_id' => $row['author_id'],
                'link' => \URLHelper::getLink('seminar_main.php#openvote',
                    array('cid' => $row['range_id'], 'voteopenID' => $row['eval_id'])),
                'updated' => max($row['startdate'], $row['chdate']),
                'summary' => sprintf('%s %s hat in der Veranstaltung "%s" die Evaluation "%s" gestartet.',
                    $row['Vorname'], $row['Nachname'], $row['Name'], $row['title']),
                'content' => $row['text'],
                'category' => 'surveys'
            );
        }

        if($seminar_cur == 0)
        {
            $sql = "SELECT eval.*, $inst_fields
                    FROM eval
                    JOIN eval_range USING (eval_id)
                    JOIN auth_user_md5 ON (author_id = user_id)
                    JOIN user_inst ON (range_id = Institut_id)
                    JOIN Institute USING (Institut_id)
                    WHERE $inst_filter AND eval.startdate BETWEEN $chdate AND $now";

            $result = $db->query($sql);

            foreach ($result as $row) {
                $items[] = array(
                    'id' => $row['eval_id'],
                    'title' => $row['title'],
                    'author' => $row['Vorname'] . ' ' . $row['Nachname'],
                    'author_id' => $row['author_id'],
                    'link' => \URLHelper::getLink('institut_main.php#openvote',
                        array('cid' => $row['range_id'], 'voteopenID' => $row['eval_id'])),
                    'updated' => max($row['startdate'], $row['chdate']),
                    'summary' => sprintf('%s %s hat in der Einrichtung "%s" die Evaluation "%s" gestartet.',
                        $row['Vorname'], $row['Nachname'], $row['Name'], $row['title']),
                    'content' => $row['text'],
                    'category' => 'surveys'
                );
            }
        }

        // sort everything

        usort($items, create_function('$a, $b', 'return $b["updated"] - $a["updated"];'));
        $items = array_slice($items, 0, 100);

        return $items;
    }
}
