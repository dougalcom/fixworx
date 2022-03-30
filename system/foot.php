<?
	// get the last line of the status file
	$status = read_last_line($fxwx_path.'system/status.txt');
?>
			<hr/>
			<span style="float:right;"><small><strong>fxwx</strong> v.<?=$fxwx_version?></small></span><br/>
		</div>
	</div>
</body>

<script>
	$(document).ready(function() {
		console.log("fxwx: document loaded");
		$('#statusbar').html('<small><strong>Status:</strong> <?=$status?></small>');
		$('#sortTable').DataTable( {
			retrieve: true,
			paging: true,
			autoWidth: true,
			info: true
		} );
	});
</script>

</html>
<?
	// close db conn
	$dbhandle = null;
?>