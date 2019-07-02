<?php
namespace App\Models\Report;

class CustomerReportColumnMap extends Model {
    protected $table = 'customer_report_column_map';

    public function customer_report() {
        return $this->belongsTo('App\Models\Report\CustomerReport', 'report_id');
    }
    public function customer_report_column() {
        return $this->belongsTo('App\Models\Report\CustomerReportColumn', 'column_id');
    }
}
