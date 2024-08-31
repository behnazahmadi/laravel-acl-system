<!-- latest jquery-->
<script src="{{asset("assets/js/jquery-3.5.1.min.js")}}"></script>
<!-- feather icon js-->
<script src="{{asset("assets/js/icons/feather-icon/feather.min.js")}}"></script>
<script src="{{asset("assets/js/icons/feather-icon/feather-icon.js")}}"></script>
<!-- Sidebar jquery-->
<script src="{{asset("assets/js/sidebar-menu.js")}}"></script>
<script src="{{asset("assets/js/config.js")}}"></script>
<!-- Bootstrap js-->
<script src="{{asset("assets/js/bootstrap/popper.min.js")}}"></script>
<script src="{{asset("assets/js/bootstrap/bootstrap.min.js")}}"></script>
<!-- Plugins JS start-->
{{--<script src="{{asset("assets/js/chart/chartist/chartist.js")}}"></script>--}}
{{--<script src="{{asset("assets/js/chart/chartist/chartist-plugin-tooltip.js")}}"></script>--}}
<script src="{{asset("assets/js/chart/knob/knob.min.js")}}"></script>
<script src="{{asset("assets/js/chart/knob/knob-chart.js")}}"></script>
<script src="{{asset("assets/js/chart/apex-chart/apex-chart.js")}}"></script>
<script src="{{asset("assets/js/chart/apex-chart/stock-prices.js")}}"></script>
<script src="{{asset("assets/js/prism/prism.min.js")}}"></script>
<script src="{{asset("assets/js/clipboard/clipboard.min.js")}}"></script>
<script src="{{asset("assets/js/counter/jquery.waypoints.min.js")}}"></script>
<script src="{{asset("assets/js/counter/jquery.counterup.min.js")}}"></script>
<script src="{{asset("assets/js/counter/counter-custom.js")}}"></script>
<script src="{{asset("assets/js/custom-card/custom-card.js")}}"></script>
{{--<script src="{{asset("assets/js/notify/index.js")}}"></script>--}}
{{--<script src="{{asset("assets/js/datepicker/date-picker/datepicker.js")}}"></script>--}}
{{--<script src="{{asset("assets/js/datepicker/date-picker/datepicker.en.js")}}"></script>--}}
{{--<script src="{{asset("assets/js/datepicker/date-picker/datepicker.custom.js")}}"></script>--}}
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{asset("assets/js/script.js")}}"></script>
<script src="{{asset("toastr.min.js")}}"></script>
<!-- login js-->
<!-- Plugin used-->
<script>

    @if(session()->has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.success("{{ session('message') }}");
    @endif

        @if(session()->has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(session()->has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(session()->has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@yield("scripts")
