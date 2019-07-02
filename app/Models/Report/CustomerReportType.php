<?php
namespace App\Models\Report;

class CustomerReportType extends Model {
    protected $table = 'customer_report_type';

	public function customer_report_column() {
        return $this->HasMany('App\Models\Report\CustomerReportColumn', 'crt_id');
    }
    public function customer_report_condition() {
        return $this->HasMany('App\Models\Report\CustomerReportCondition', 'crt_id');
    }
    public function customer_report() {
        return $this->HasMany('App\Models\Report\CustomerReport', 'crt_id');
    }
    public function report_data() {
        return $this->HasMany('App\Models\Report\ReportData', 'rd_code');
    }
}
