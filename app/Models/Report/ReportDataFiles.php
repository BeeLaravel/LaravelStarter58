<?php
namespace App\Models\Report;

class ReportDataFiles extends Model {
    protected $table = 'report_data_files';

    public function report_data() {
        return $this->belongsTo('App\Models\Report\ReportData', 'rd_id');
    }
}
