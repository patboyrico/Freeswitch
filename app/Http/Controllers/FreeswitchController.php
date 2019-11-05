<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use XMLWriter;

class FreeswitchController extends Controller
{
    public function xmlHandler()
    {
        $users = User::all();
        if(count($users) == 0){
            return $this->notFound();
        }

        Header("Content-type: text/xml");
        $xmlw = new XMLWriter();
        $xmlw -> openMemory();
        $xmlw -> setIndent(true);
        $xmlw -> setIndentString('');
        $xmlw -> startDocument('1.0', 'UTF-8', 'no');
        $xmlw -> startElement('document');
        $xmlw -> writeAttribute('type', 'freeswitch/xml');
        $xmlw -> startElement('section');
        $xmlw -> writeAttribute('name', 'directory');
        $xmlw -> startElement('domain');
        $xmlw -> writeAttribute('name','$${domain}');
        $xmlw -> startElement('params');
        $xmlw -> startElement('param');
        $xmlw -> writeAttribute('name', 'dial-string');
        $xmlw -> writeAttribute('value', '{^^:sip_invite_domain=${dialed_domain}:presence_id=${dialed_user}@${dialed_domain}}${sofia_contact(*/${dialed_user}@${dialed_domain})}');
        $xmlw -> endElement(); //end param
        $xmlw -> endElement(); //end param
        foreach( $users as $user ) {
        $xmlw -> startElement('user');
        $xmlw -> writeAttribute('id', $user->user_extension->J_Number);
        // Params
        $xmlw -> startElement('params');
        $xmlw -> startElement('param');
        $xmlw -> writeAttribute('name', 'password');
        $xmlw -> writeAttribute('value', $user->password);
        $xmlw -> endElement();
        $xmlw -> startElement('param');
        $xmlw -> writeAttribute('name', 'vm-password');
        $xmlw -> writeAttribute('value', $user->user_configuration->four_digit_pin);
        $xmlw -> endElement();
        $xmlw -> endElement(); //end params
        // Variables
        $xmlw -> startElement('variables');
        $xmlw -> startElement('variable');
        $xmlw -> writeAttribute('name', 'accountcode');
        $xmlw -> writeAttribute('value',$user->user_extension->J_Number );
        $xmlw -> endElement();
        $xmlw -> startElement('variable');
        $xmlw -> writeAttribute('name', 'user_context');
        $xmlw -> writeAttribute('value', 'default');
        $xmlw -> endElement();
        $xmlw -> startElement('variable');
        $xmlw -> writeAttribute('name', 'effective_caller_id_name');
        $xmlw -> writeAttribute('value', $user->full_name);
        $xmlw -> endElement();
        $xmlw -> startElement('variable');
        $xmlw -> writeAttribute('name', 'effective_caller_id_number');
        $xmlw -> writeAttribute('value', $user->user_configuration->phone_number);
        $xmlw -> endElement();
        $xmlw -> startElement('variable');
        $xmlw -> writeAttribute('name', 'outbound_caller_id_name');
        $xmlw -> writeAttribute('value', $user->full_name);
        $xmlw -> endElement();
        $xmlw -> startElement('variable');
        $xmlw -> writeAttribute('name', 'outbound_caller_id_number');
        $xmlw -> writeAttribute('value', $user->user_configuration->phone_number);
        $xmlw -> endElement();
        $xmlw -> endElement(); //end variables
        $xmlw -> endElement(); //end user
        } // end while
        $xmlw -> endElement(); //end domain
        $xmlw -> endElement(); //end section
        $xmlw -> endDocument(); //end document
        echo $xmlw -> outputMemory();
        return;



    }

    public function notFound()
    {
        Header("Content-type: text/xml");
        $xmlw = new XMLWriter();
        $xmlw -> openMemory();
        $xmlw -> setIndent(true);
        $xmlw -> setIndentString('');
        $xmlw -> startDocument('1.0', 'UTF-8', 'no');
        $xmlw -> startElement('document');
        $xmlw -> writeAttribute('type', 'freeswitch/xml');
        $xmlw -> startElement('section');
        $xmlw -> writeAttribute('name', 'result');
        $xmlw -> startElement('result');
        $xmlw -> writeAttribute('status', 'not found');
        $xmlw -> endElement(); //end result
        $xmlw -> endElement(); //end section
        $xmlw -> endDocument(); //end document
        echo $xmlw -> outputMemory();
        dd($xmlw);
        return;
    }

}
