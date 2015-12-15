<?php

namespace App\libs\upload;

class Upload
{
    protected $destination;
    protected $max = 2000000;
    protected $messages = [];
    protected $permitted = ['jpg','jpeg', 'gif', 'png'];
    protected $newName;
    protected $renameDuplicates;

    public function __construct($path)
    {
        if ( !is_dir($path) || !is_writable($path) ) {
            throw new \Exception('path must be valid writable directory');
        }

        $this->destination = $path;
    }

    public function upload($renameDuplicates = true)
    {
        $this->renameDuplicates = $renameDuplicates;

        $uploaded = current($_FILES);

        if ( is_array($uploaded['name']) )  {
            // deal with multiple uploads
            foreach ($uploaded['name'] as $key => $value) {
                $currentFile['name'] = $uploaded['name'][$key];
                $currentFile['tmp_name'] = $uploaded['tmp_name'][$key];
                $currentFile['error'] = $uploaded['error'][$key];
                $currentFile['size'] = $uploaded['size'][$key];

                if ($this->checkFile($currentFile)) {
                    $this->moveFile($currentFile);
                }
            }
        } else {

            if ($this->checkFile($uploaded)) {
                $this->moveFile($uploaded);
            }
        }


    }

    public function getMaxSize()
    {
        return number_format($this->max / 1000, 1) . ' KB';
    }

    public function setMaxSize($num)
    {
        if (is_numeric($num) && $num > 0) {
            $this->max = (int) $num;
        }
    }

    protected function checkFile($file)
    {
        $accept = true;
        if ($file['error'] != 0) {
            $this->getErrorMessage($file);
            // stop checking if no file sumitted
            if ($file['error'] == 4) {
                return false;
            } else {
                $accept = false;
            }
        }

        if (!$this->checkSize($file)) {
            $accept = false;
        }

        if (!$this->checkType($file)) {
            $accept = false;
        }

        if ($accept) {
            $this->checkName($file);
        }

        return $accept;
    }

    protected function moveFile($file)
    {
        $name = ($this->newName != null) ? $this->newName : $file['name'];

        $success = move_uploaded_file($file['tmp_name'], $this->destination . $name);
        if ($success) {
            $result = $file['name'] . ' was uploaded successfully';
            if (!is_null($this->newName)) {
                $result .= ', and was renamed to ' . $this->newName;
            }
//            $this->messages[] = $result;
        } else {
            $this->messages[] = ' Could not upload ' . $file['name'];
        }
    }

    protected function getErrorMessage($file)
    {
        switch($file['error']) {
            case 1:
            case 2:
                $this->messages[] = $file['name'] . ' is too big:(max: ' . $this->getMaxSize() . ' )';
                break;
            case 3:
                $this->messages[] = $file['name'] . ' was only Partially uploaded.';
                break;
            case 4:
                $this->messages[] = 'No file submitted.';
                break;
            default:
                $this->messages[] = 'Sorry there was problem uploading ' . $file['name'];
                break;
        }
    }

    protected function checkSize($file)
    {
        if ($file['error'] == 1 || $file['error'] == 2) {
            return false;

        } elseif($file['size'] == 0) {
            $this->messages[] = $file['name'] . ' is an empty file';
            return false;

        } elseif ($file['size'] > $this->max) {
            $this->messages[] = $file['name'] . ' exceeds the maximum size for a file ( ' . $this->getMaxSize() . ' ) ';
            return false;
        } else {
            return true;
        }
    }

    protected function checkType($file)
    {
        $ext = explode('.', $file['name']);
        $ext = strtolower(end($ext));
        if ( !in_array($ext, $this->permitted) ) {
            $this->messages[] = $file['name'] . ' is not permitted type of file.';
            return false;
        }

        return true;
    }

    protected function checkName($file)
    {
        $this->newName = null;
        $nospaces = str_replace(' ', '_', $file['name']);
        if ($nospaces != $file['name']) {
            $this->newName = $nospaces;
        }

        if ($this->renameDuplicates) {
            $name = isset($this->newName) ? $this->newName : $file['name'];
            $existing = scandir($this->destination);
            if (in_array($name, $existing)) {
                // rename file
                $basename = pathinfo($name, PATHINFO_FILENAME);
                $extension = pathinfo($name, PATHINFO_EXTENSION);

                $i = 1;
                do {
                    $this->newName = $basename . '_' . $i++;
                    if (!empty($extension)) {
                        $this->newName .= ".$extension";
                    }
                } while (in_array($this->newName, $existing)) ;
            }
        }
    }


    public function getMessages()
    {
        return $this->messages;
    }

}