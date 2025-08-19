<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Share now')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="share"></div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    $(document).ready(function(){
        $("#share").jsSocials({
            showLabel: false,
            showCount: false,
            shares: [
                {
                    share: "email",
                    logo: "fas fa-envelope",
                    onClick: function () {
                        var productURL = "{{ route('property.detail', $property->slug) }}";
                        var emailSubject = "Check out this property!";
                        var emailBody = "I found this property and thought you might be interested: " + productURL;
                        var mailtoLink = 'mailto:?subject=' + encodeURIComponent(emailSubject) + '&body=' + encodeURIComponent(emailBody);
                        window.open(mailtoLink);
                    }
                },
                {
                    share: "twitter",
                    logo: "fab fa-twitter",
                    onClick: function () {
                        var productURL = "{{ route('property.detail', $property->slug) }}";
                        var twitterShareURL = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(productURL);
                        window.open(twitterShareURL, '_blank');
                    }
                },
                {
                    share: "facebook",
                    logo: "fab fa-facebook-f",
                    onClick: function () {
                        var productURL = "{{ route('property.detail', $property->slug) }}";
                        var facebookShareURL = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(productURL);
                        window.open(facebookShareURL, '_blank');
                    }
                },
                {
                    share: "linkedin",
                    logo: "fab fa-linkedin",
                    onClick: function () {
                        var productURL = "{{ route('property.detail', $property->slug) }}";
                        var linkedInShareURL = 'https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(productURL);
                        window.open(linkedInShareURL, '_blank');
                    }
                },
                {
                    share: "whatsapp",
                    logo: "fab fa-whatsapp",
                    onClick: function () {
                        var productURL = "{{ route('property.detail', $property->slug) }}";
                        var whatsappShareURL = 'whatsapp://send?text=' + encodeURIComponent(productURL);
                        window.open(whatsappShareURL);
                    }
                }
            ]
        });
    });
</script>
@endpush
