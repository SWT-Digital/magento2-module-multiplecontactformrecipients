<?php

declare(strict_types=1);

namespace SwtDigital\MultipleContactFormRecipients\Plugin;

use function count;
use function explode;
use Magento\Contact\Model\Config as ContactConfig;

class Config
{
    /**
     * @param ContactConfig $subject
     * @param string $result
     * @return string|array
     */
    public function afterEmailRecipient(
        ContactConfig $subject,
        string $result
    ) {
        $emails = explode(',', $result);

        return $emails !== false && count($emails) > 1 ?
            $emails :
            $result;
    }
}
