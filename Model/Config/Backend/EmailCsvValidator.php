<?php

declare(strict_types=1);

namespace SwtDigital\MultipleContactFormRecipients\Model\Config\Backend;

use function explode;
use function array_walk;
use function filter_var;
use Magento\Framework\App\Config\Value;
use Magento\Framework\Exception\ValidatorException;

class EmailCsvValidator extends Value
{
    /**
     * @return Value
     * @throws ValidatorException
     */
    public function beforeSave(): Value
    {
        $emails = explode(',', $this->getValue());

        if ($emails === false) {
            return parent::beforeSave();
        }

        array_walk($emails, function ($value) {
            if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
                throw new ValidatorException(
                    __(
                        'Invalid email entered ( %1 )',
                        empty($value) === true ?
                            __('Empty value detected') :
                            (string)$value
                    )
                );
            }
        });

        return parent::beforeSave();
    }
}
