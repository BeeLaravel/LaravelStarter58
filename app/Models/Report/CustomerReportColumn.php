<?php
namespace App\Models\Report;

class CustomerReportColumn extends Model {
    protected $table = 'customer_report_column';

    public function customer_report_type() {
        return $this->belongsTo('App\Models\Report\CustomerReportType', 'crt_id');
    }
    public function customer_report_column_map() {
        return $this->HasMany('App\Models\Report\CustomerReportColumnMap', 'column_id');
    }
}
