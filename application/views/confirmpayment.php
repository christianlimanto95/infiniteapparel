<div id="container">
	<div class='subtitle'>CONFIRM PAYMENT</div>
	<?php
	echo "<div class='total'>Total : <span>" . $totalResults . "</span></div>";
	if (count($waitingconfirm) > 0)
	{
		$resultCtr = ($page - 1) * 10;
		foreach ($waitingconfirm as $row)
		{
			$resultCtr++;
			
			echo "<div class='result-ctr'>" . $resultCtr . ". </div>";
			echo "<a href='" . site_url("project/detail/" . $row->hjual_id) . "' class='result-each'>";
				echo "<table class='confirm-table'>";
					echo "<tr>";
						echo "<td>ID</td>";
						echo "<td> : " . $row->hjual_id . "</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td>Username</td>";
						echo "<td> : " . $row->user_email . "</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td>Total</td>";
						echo "<td> : " . number_format($row->hjual_grand_total_price, 0, ",", ".") . " IDR</td>";
					echo "</tr>";
					
				echo "</table>";				
			echo "</a>";
		}
		
		$totalPage = $totalResults / 16;
		$int = intval($totalPage);
		if ($totalPage > $int) {
			$totalPage = $int + 1;
		}

		echo "<div class='page'>";
			echo "<span>Page : </span>";
			for ($i = 1; $i <= $totalPage; $i++)
			{
				$activePage = "";
				if ($i == $page)
				{
					$activePage = "active";
				}
				echo "<a href='" . site_url("project/confirmpayment/" . $i) . "' class='page-each " . $activePage . "'><button>" . $i . "</button></a>";
			}
		echo "</div>";
	}
	?>
</div>