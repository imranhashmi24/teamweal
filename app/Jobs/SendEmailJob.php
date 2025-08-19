<?php

namespace App\Jobs;

use App\Models\Mail\History;
use App\Models\Mail\MailCategory;
use App\Models\Mail\Template;
use App\Traits\SmsTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Traits\MailConfigTrait;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, MailConfigTrait, SmsTrait;

    public $history_id;

    /**
     * Create a new job instance.
     *
     * @param int $history_id
     * @return void
     */
    public function __construct($history_id)
    {
        $this->history_id = $history_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $history = History::where("id", $this->history_id)->first();
        
  
        if($history) {
            if($history->group_id){
                try {

                    $contactGroup = MailCategory::with('contacts')->findOrFail($history->group_id);
                    $this->historyUpdateRunning($history);
                    foreach ($contactGroup->contacts as $contact) {

                        if($history->template_code !== null){
                            $s_code = $this->sCode($history->template_code, $contact);
                            $detail = $this->templateConfig($history->template_code, $s_code);
                            $body = $detail['message_body'];
                        }else{
                            $body = $history->message;
                        }

                        $data = [
                            "subject"        => $history->subject,
                            "email_from"     => $history->domain,
                            "site_name"      => "Export incubator",
                            "email"          => $contact->email,
                            "receiverName"   => $contact->email,
                            "body"           => $body,
                            "attachments"    => $history->attachment
                        ];

                        $this->sendSmtpMail($history->domain, $data);

                        sleep(30);
                    }

                    $this->historyUpdateCompleted($history);
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                }



            } else {
                $this->handleMailSend($history);

                $this->historyUpdateCompleted($history);
            }
        }

    }

    public function handleMailSend($history)
    {
        $this->historyUpdateRunning($history);
        foreach (json_decode($history->email, true) as $email) {

            $data = [
                "subject"        => $history->subject,
                "email_from"     => $history->domain,
                "site_name"      => "Technical incubator",
                "email"          => $email,
                "receiverName"   => $email,
                "body"           => $history->message,
                "attachments"    => $history->attachment
            ];

            $this->sendSmtpMail($history->domain, $data);

            sleep(30);
        }
        
       
    }
    
    
    public function historyUpdateRunning($history)
    {
        $history = History::find($history->id);

        $history->status = 1;
        $history->save();

    }


    protected function historyUpdateCompleted($history)
    {
        $history = History::find($history->id);
        $history->status = 2;
        $history->save();

        Log::info($history->status);
    }



    protected  function sCode($template_code, $contact)
    {

        $template = Template::where('code', $template_code)->first();


        $s_encodes = $template->short_code;

        $code = [];

        foreach (json_decode($s_encodes, true) as $key => $s_code){
            $cleaned_value = preg_replace('/[^\w\s]/', '', $s_code);
            $code[$cleaned_value] = $contact->name;
        }

        return $code;

    }


    public function sendSmtpMail($domain, $history){

		$mail = new PHPMailer(true);
        $config = $this->mailConfig($domain);

        //Server settings
        $mail->isSMTP();

        $mail->Host       = $config['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['username'];
        $mail->Password   = $config['password'];
        if ($config['encryption'] == 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        }else{
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }
        $mail->Port       = $config['port'];
        $mail->CharSet = 'UTF-8';


        $attachments = json_decode($history['attachments'], true);

        if ($attachments !== null && is_array($attachments)) {
            foreach ($attachments as $key => $attachment) {
                $attachmentPath = public_path('/assets/documents/') . $attachment;
                $mail->addAttachment($attachmentPath, $attachment);
            }
        }

        //Recipients
        $mail->setFrom($config['domain'], $history['site_name']);
        $mail->addAddress($history['email'], $history['receiverName']);
        $mail->addReplyTo($config['domain'], $history['site_name']);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $history['subject'];

        $mail->Body    = htmlspecialchars($history['body']);

        $mail->send();
	}

}
