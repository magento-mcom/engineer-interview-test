<?php

namespace Magento\Test;

use Magento\Report;

class ReportTest extends \PHPUnit_Framework_TestCase
{
    public function testSendReportInHtmlFormat()
    {
        $report = new Report();

        $report->setTitle('');
        $report->setDate();
        $report->setContent('This is the content');

        $types = ['HTML', 'JSON'];

        foreach ($types as $type){
            if ($report->validate()) {
                $this->assertTrue($report->sendReport($type));
            } else {
                $this->assertFalse($report->sendReport($type));
            }
        }
    }
}
