<?php
    function getUserTemplatex($self, $uid, $finger)
    {
        $template_data = ''; //x
        $user_data = array(); //x
        $command = CMD_USERTEMP_RRQ; //belum
        $byte1 = chr((int) ($uid % 256)); //x
        $byte2 = chr((int) ($uid >> 8)); //x
        $command_string = $byte1 . $byte2 . chr($finger); //x
        $chksum = 0; //x
        $session_id = $self->session_id; //ada
        $u = unpack('H2h1/H2h2/H2h3/H2h4/H2h5/H2h6/H2h7/H2h8', substr($self->data_recv, 0, 8));
        $reply_id = hexdec($u['h8'] . $u['h7']); //x
        $buf = $self->createHeader($command, $chksum, $session_id, $reply_id, $command_string); //x
        socket_sendto($self->zkclient, $buf, strlen($buf), 0, $self->ip, $self->port); //x
        try {
            socket_recvfrom($self->zkclient, $self->data_recv, 1024, 0, $self->ip, $self->port);
            $u = unpack('H2h1/H2h2/H2h3/H2h4/H2h5/H2h6', substr($self->data_recv, 0, 8)); //x
            $bytes = getSizeTemplate($self);//sudah
            if ($bytes) {
                while ($bytes > 0) {
                    socket_recvfrom($self->zkclient, $self->data_recv, 1032, 0, $self->ip, $self->port); //x
                    array_push($user_data, $self->data_recv); //x
                    $bytes -= 1024; //x
                }
                $self->session_id =  hexdec($u['h6'] . $u['h5']); //x
                socket_recvfrom($self->zkclient, $self->data_recv, 1024, 0, $self->ip, $self->port); //x
            }
            $template_data = array(); //a
            if (count($user_data) > 0) {
                for ($x = 0; $x < count($user_data); $x++) {
                    if ($x == 0) {
                        $user_data[$x] = substr($user_data[$x], 8);
                    } else {
                        $user_data[$x] = substr($user_data[$x], 8);
                    }
                }
                $user_data = implode('', $user_data);
                $template_size = strlen($user_data) + 6;
                $prefix = chr($template_size % 256) . chr(round($template_size / 256)) . $byte1 . $byte2 . chr($finger) . chr(1);
                $user_data = $prefix . $user_data;
                if (strlen($user_data) > 6) {
                    $valid = 1;
                    $template_data = array($template_size, $uid, $finger, $valid, $user_data);
                }
            }
            return $template_data;
        } catch (ErrorException $e) {
            return false;
        } catch (exception $e) {
            return false;
        }
    }

    function getSizeTemplate($self)
    {
        $u = unpack('H2h1/H2h2/H2h3/H2h4/H2h5/H2h6/H2h7/H2h8', substr($self->data_recv, 0, 8));
        $command = hexdec($u['h2'] . $u['h1']);
        if ($command == CMD_PREPARE_DATA) {
            $u = unpack('H2h1/H2h2/H2h3/H2h4', substr($self->data_recv, 8, 4));
            $size = hexdec($u['h4'] . $u['h3'] . $u['h2'] . $u['h1']);
            return $size;
        } else {
            return false;
        }
    }

    function getUserTemplateAllx($self, $uid)
    {
        $template = array();
        $j = 0;
        for ($i = 5; $i < 10; $i++, $j++) {
            $template[$j] = getUserTemplatex($self, $uid, $i);
        }
        for ($i = 4; $i >= 0; $i--, $j++) {
            $template[$j] = getUserTemplatex($self, $uid, $i);
        }
        return $template;
    }

?>