<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateFreeswitchExtension implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        header('Content-Type: text/xml');
        $xmlw = new XMLWriter();
        $xmlw -> openMemory();
        $xmlw -> setIndent(true);
        $xmlw -> setIndentString('  ');
        $xmlw -> startDocument('1.0', 'UTF-8', 'no');

        $xmlw -> startElement('document');
        $xmlw -> writeAttribute('type', 'freeswitch/xml');

        $xmlw -> startElement('section');
        $xmlw -> writeAttribute('name', 'dialplan');
        $xmlw -> writeAttribute('description', 'RE Dial Plan For FreeSwitch');

        //start the context
        $xmlw -> startElement('context');
        $xmlw -> writeAttribute('name', 'default');

        //start an extension
        $xmlw -> startElement('extension');
        $xmlw -> writeAttribute('name', 'test9');

        //write the condition to match on
        $xmlw -> startElement('condition');
        $xmlw -> writeAttribute('field', 'destination_number');
        $xmlw -> writeAttribute('expression', '^83789$');

        //set the action/anti-action to take
        $xmlw -> startElement('action');
        $xmlw -> writeAttribute('application', 'bridge');
        $xmlw -> writeAttribute('data', 'iax/guest@conference.freeswitch.org/888');

        //</action>
        $xmlw -> endElement();
        //</condition>
        $xmlw -> endElement();
        // </extension>
        $xmlw -> endElement();
        // </context>
        $xmlw -> endElement();
        //</section>
        $xmlw -> endElement();
        //</document>
        $xmlw -> endElement();
        echo $xmlw -> outputMemory();


    }
}
