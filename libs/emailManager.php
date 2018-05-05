<?php

/* If the person is accepted into RATELIMITED,  this email should be used */

function sendAcceptanceEmail ($email, $userName, $token){
	include __DIR__ . '/../../sendgridcreds.inc.php';
	         /* Send an e-mail to the recipient */
                $sendgridFrom = new SendGrid\Email("RATELIMITED", "support@ratelimited.me");
                $sendgridSubject = "Your RATELIMITED Token Request Has Been Approved!";
                $sendgridTo = new SendGrid\Email(null, $email);
                $sendgridContent = new SendGrid\Content("text/html", "<!DOCTYPE html>
<html>
    <body>
        <center style=\"font-family: Arial, Geneva, sans-serif;\">
            <img src=\"https://cdn.ratelimited.me/dark_logo.png\"></img>
            <h1>RATELIMITED.ME</h1>
            <p>
                Hi there, " . $userName . ",
                <br>
                <br>
                This e-mail is here to notify you about your token for the service. If you need any support, contact us via email over at support@ratelimited.me!
                <br>
                Keep it safe, and don&#8217;t share it with anybody.
                <br>
                <br>
                Token: <code style=\"font-family: Courier, monospace;\">" . $token . "</code>
                <br>
                <br>
                Note: Want to be kept up-to-date with what happens with the service? Join our Discord over at: <a href=\"https://discord.gg/9bbDRHP\">https://discord.gg/9bbDRHP</a> !
                <br>
                <br>
                - RATELIMITED.ME
            </p>
        </center>
    </body>
</html>");

           $sendgridMail = new SendGrid\Mail($sendgridFrom, $sendgridSubject, $sendgridTo, $sendgridContent);
           //$sendgridAPIKey = "Moved and is now included because I'm not leaking my creds bitches <3 -George";
           $sg = new \SendGrid($sendgridAPIKey);

           $sg->client->mail()->send()->post($sendgridMail);
	       echo json_encode(array('success' => 'true', 'details' => 'E-Mail sent to requester successfully.'));
}

/* Otherwise, this e-mail should be sent when declining someone */

function sendDeclineEmail ($email, $username) { /* TODO: Add a REASON popup before declining for custom reasons */
	include __DIR__ . '/../../sendgridcreds.inc.php';
	         /* Send an e-mail to the recipient */
                $sendgridFrom = new SendGrid\Email("RATELIMITED", "support@ratelimited.me");
                $sendgridSubject = "Update on your RATELIMITED Token Request";
                $sendgridTo = new SendGrid\Email(null, $email);
                $sendgridContent = new SendGrid\Content("text/html", "<!DOCTYPE html>
<html>
    <body>
        <center style=\"font-family: Arial, Geneva, sans-serif;\">
            <img src=\"https://cdn.ratelimited.me/dark_logo.png\"></img>
            <h1>RATELIMITED.ME</h1>
            <p>
                Hi there, " . $userName . ",
                <br>
                <br>
                Sadly, we were unable to accept you into RATELIMITED due to some complications. Most of the time, the reasons for declining a token are either:
                <br>
                <ul>
                <li>You are not in the <a href=\"https://discord.gg/9bbDRHP\">RATELIMITED Discord Server</a></li>
                <li>You already have a token and as such, we are unable to create a new one for you</li>
                <li>You may have requested a token multiple times. If that is the case, please wait one (1) day and apply again <i>once</i></li>
                <br>
                <br>
                Thanks for flying Air RATELIMITED!
                <br>
                <br>
                Note: Want to be kept up-to-date with what happens with the service? Join our Discord over at: <a href=\"https://discord.gg/9bbDRHP\">https://discord.gg/9bbDRHP</a> !
                <br>
                <br>
                - RATELIMITED.ME
            </p>
        </center>
    </body>
</html>");

           $sendgridMail = new SendGrid\Mail($sendgridFrom, $sendgridSubject, $sendgridTo, $sendgridContent);
           //$sendgridAPIKey = "Moved and is now included because I'm not leaking my creds bitches <3 -George";
           $sg = new \SendGrid($sendgridAPIKey);

           $sg->client->mail()->send()->post($sendgridMail);
	       echo json_encode(array('success' => 'true', 'details' => 'E-Mail notification sent successfully.'));
}

?>