<?php

namespace Magento;

class Report
{
    private $title;
    private $date;
    private $content;

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDate($date = null)
    {
        if (!$date) {
            $this->date = (new \DateTime())->format('y-m-d h:i:s');
        } else {
            $this->date = $date;
        }
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function validate()
    {
        if (empty($this->title)) {
            return false;
        }

        if (empty($this->date)) {
            return false;
        }

        if (empty($this->content)) {
            return false;
        }

        return true;
    }

    public function formatJson()
    {
        return json_encode($this->reportToArray());
    }

    public function reportToArray()
    {
        return [
            'title' => $this->title,
            'date' => $this->date,
            'content' => $this->content
        ];
    }

    public function formatHtml()
    {
        return "
            <h1>{$this->title}</h1> .
            <p>{$this->date}</p> .
            <div class='content'>{$this->content}</div> .
        ";
    }

    public function sendReport($type)
    {
        if ($this->validate())
        {
            if ($type == 'HTML')
            {
                $mailer = new Mailer();
                $mailer->send($this->formatHtml());
                return true;
            }

            if ($type == 'JSON')
            {
                $mailer = new Mailer();
                $mailer->send($this->formatJson());
                return true;
            }
        }

        return false;
    }
}
