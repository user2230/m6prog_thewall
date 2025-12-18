<?php

function render_message(Message $message): string
{
    $name = htmlspecialchars($message->name);
    $bericht = htmlspecialchars($message->bericht);

    return <<<HTML
        <div class="message">
            <p class="message-text">{$bericht}</p>
            <p class="message-sender">{$name}</p>
        </div>
    HTML;
}
