<?php
namespace App\Models\Report;

class ReportData extends Model {
    protected $table = 'report_data';

    public function customer_report_type() {
        return $this->belongsTo('App\Models\Report\CustomerReportType', 'rd_code');
    }
    public function report_data_files() {
        return $this->hasOne('App\Models\Report\ReportDataFiles', 'rd_id');
    }
    public function customer_report_permissions() {
        return $this->hasMany('App\Models\Report\CustomerReportPermissions', 'report_id');
    }
}
