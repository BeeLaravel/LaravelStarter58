<?php
namespace App\Models\Report;

class CustomerReportConditionMap extends Model {
    protected $table = 'customer_report_condition_map';

    public function customer_report() {
        return $this->belongsTo('App\Models\Report\CustomerReport', 'report_id');
    }
    public function customer_report_condition() {
        return $this->belongsTo('App\Models\Report\CustomerReportCondition', 'condition_id');
    }
}
