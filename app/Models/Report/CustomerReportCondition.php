<?php
namespace App\Models\Report;

class CustomerReportCondition extends Model {
    protected $table = 'report_data_condition';

    public function customer_report_type() {
        return $this->belongsTo('App\Models\Report\CustomerReportType', 'crt_id');
    }
    public function customer_report_condition_map() {
        return $this->HasMany('App\Models\Report\CustomerReportConditionMap', 'condition_id');
    }
}
