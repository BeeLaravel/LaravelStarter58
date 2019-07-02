<?php
namespace App\Models\Report;

class CustomerReportPermissions extends Model {
	protected $table = 'customer_report_permissions';

	public function customer_report() {
        return $this->belongsTo('App\Models\Report\ReportData', 'report_id');
    }
}
