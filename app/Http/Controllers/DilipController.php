<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Client;
use Smalot\PdfParser\Parser;

class DilipController extends Controller
{
    public function getemails(){
        $oClient = Client::account('default');
        $oClient->connect();
        $aFolder = $oClient->getFolder('INBOX');
        $mails = $aFolder->query()->all()->get();
        $oClient->disconnect();

        return view('welcome')->withMails($mails);
    }

    public function pdfparse(Request $request){
        $oClient = Client::account('default');
        $oClient->connect();
        $aFolder = $oClient->getFolder('INBOX');

        $aMessage = $aFolder->getMessage($uid = $request->uid,null,null,true,true);
        //dd($aMessage);
        $aAttachment = $aMessage->getAttachments();
        //dd($aAttachment);
        $aAttachment->each(function ($oAttachment) {
            /** @var \Webklex\IMAP\Attachment $oAttachment */
            $oAttachment->save(public_path());
        });

        

        // $PDFParser = new Parser();
        // $pdf = $PDFParser->parseFile(public_path('pdf/dp.pdf'));
        // $text = $pdf->getText();

        // dd($text);

         $PDFParser = new Parser();
        $pdf = $PDFParser->parseFile(public_path('dp.pdf'));
        $text = $pdf->getText();

        dd($text);
    }
}
