<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Base64ImageValidationRule implements Rule
{

    protected array $messages;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->messages = [];
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        try {
            $binary = base64_decode(explode(',', $value)[1]);

            $data = getimagesizefromstring($binary);

            $size = (int)(strlen(rtrim($value, '=')) * 0.75);


        } catch (\Exception $e) {

            $this->messages[] = 'The image must be an image.';

            return false;
        }

        $allowed = ['image/jpeg', 'image/png', 'image/gif'];

        if (!$data) {

            $this->messages[] = 'The image must be an image.';

            return false;
        }

        if($size/1024 > 2048) {

            $this->messages[] = 'The image must not be greater than 2048 kilobytes.';

            return false;
        }

        if (empty($data['mime'])) {

            $this->messages[] = 'The image must be a file of type: jpeg, png, jpg, gif.';

            return false;
        }

        if (!in_array($data['mime'], $allowed)) {

            $this->messages[] = 'The image must be a file of type: jpeg, png, jpg, gif.';

            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $text = "";

        foreach ($this->messages as $value) {
            $text = $text. $value. PHP_EOL;
        }

        return $text;
    }
}
