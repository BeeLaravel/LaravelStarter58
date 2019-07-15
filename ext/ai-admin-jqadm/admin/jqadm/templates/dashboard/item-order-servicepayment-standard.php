<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2016-2018
 */

$enc = $this->encoder();

?>

<div class="order-servicepayment card col-lg-6">
	<div id="order-servicepayment-head" class="card-header header" role="tab"
		data-toggle="collapse" data-target="#order-servicepayment-data"
		aria-expanded="true" aria-controls="order-servicepayment-data">
		<div class="card-tools-left">
			<div class="btn btn-card-header act-show fa"></div>
		</div>
		<span class="item-label header-label">
			<?= $enc->html( $this->translate( 'admin', 'Payment types' ) ); ?>
		</span>
	</div>
	<div id="order-servicepayment-data" class="card-block collapse show content loading" role="tabpanel"
		aria-labelledby="order-servicepayment-head">
	</div>
</div>
<?= $this->get( 'orderpaymenttypeBody' ); ?>
