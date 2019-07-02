<?php
namespace App\Models\Report;

class CustomerReport extends Model {
	protected $table = 'customer_report';

    public function customer_report_type() {
        return $this->belongsTo('App\Models\Report\CustomerReportType', 'crt_id');
    }
    public function customer_report_column_map() {
        return $this->HasMany('App\Models\Report\CustomerReportColumnMap', 'report_id');
    }
    public function customer_report_condition_map() {
        return $this->HasMany('App\Models\Report\CustomerReportConditionMap', 'report_id');
    }
}
