
<script src="{{ mix('/js/app.js') }}"></script>
{{-- <script src="https://code.jquery.com/jquery-latest.min.js"></script> --}}


<script>
    $(document).ready(function() {
        function success(pos) {
            const crd = pos.coords;
            //   console.log(`Latitude : ${crd.latitude}`);
            //   console.log(`Longitude: ${crd.longitude}`);

            const geocoder = new google.maps.Geocoder();
            const latlng = {
                lat: parseFloat(crd.latitude),
                lng: parseFloat(crd.longitude),
            };
            geocoder.geocode({
                location: latlng
            }, (results, status) => {
                if (status === "OK") {
                    if (results[1]) {
                        var country = null,
                            countryCode = null,
                            city = null,
                            cityAlt = null;
                        var c, lc, component;
                        for (var r = 0, rl = results.length; r < rl; r += 1) {
                            var result = results[r];

                            if (!city && result.types[0] === "locality") {
                                for (
                                    c = 0, lc = result.address_components.length; c < lc; c += 1
                                ) {
                                    component = result.address_components[c];

                                    if (component.types[0] === "locality") {
                                        city = component.long_name;
                                        break;
                                    }
                                }
                            } else if (
                                !city &&
                                !cityAlt &&
                                result.types[0] === "administrative_area_level_1"
                            ) {
                                for (
                                    c = 0, lc = result.address_components.length; c < lc; c += 1
                                ) {
                                    component = result.address_components[c];

                                    if (component.types[0] === "administrative_area_level_1") {
                                        cityAlt = component.long_name;
                                        break;
                                    }
                                }
                            } else if (!country && result.types[0] === "country") {
                                country = result.address_components[0].long_name;
                                countryCode = result.address_components[0].short_name;
                            }

                            if (city && country) {
                                break;
                            }
                        }

                        // automatic select country in phone field
                        var mentor_tel = document.querySelector("#mentor_tel");
                        var mentee_tel = document.querySelector("#mentee_tel");
                        window.intlTelInput(mentee_tel, ({
                            initialCountry: countryCode,
                            separateDialCode: true
                        }));

                        window.intlTelInput(mentor_tel, ({
                            initialCountry: countryCode,
                            separateDialCode: true
                        }));
                    }
                } else {
                    console.log("Geocoder failed due to: " + status);
                }
            });
        }

        function error(err) {
            var mentor_tel = document.querySelector("#mentor_tel");
            var mentee_tel = document.querySelector("#mentee_tel");
            window.intlTelInput(mentee_tel, ({
                initialCountry: 'US',
                separateDialCode: true
            }));

            window.intlTelInput(mentor_tel, ({
                initialCountry: 'US',
                separateDialCode: true
            }));
            console.log(`ERROR(${err.code}): ${err.message}`);
        }


        const options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0,
        };
        navigator.geolocation.getCurrentPosition(success, error, options);
    });
</script>
</body>
</html>
