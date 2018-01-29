<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		{c2r-result}
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 sm-taright"><a href="{c2r-path-bo}/{c2r-lg}/newsletters/" class="btn btn-export">GET BACK!</a></div>
</div>

<script type="text/javascript">
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}

function selectElementContents(el) {
        var body = document.body, range, sel;
        if (document.createRange && window.getSelection) {
            range = document.createRange();
            sel = window.getSelection();
            sel.removeAllRanges();
            try {
                range.selectNodeContents(el);
                sel.addRange(range);
            } catch (e) {
                range.selectNode(el);
                sel.addRange(range);
            }
        } else if (body.createTextRange) {
            range = body.createTextRange();
            range.moveToElementText(el);
            range.select();
        }
    }
</script>
