<template>
  <section class="mentor-profile">
    <div class="container">
      <div class="row">
        <div class="col-md-12"></div>
        <div class="col-md-12">
          <!-- general info -->

          <div class="row">
            <div class="col-md-3 border-end-c">
              <div class="info">
                <span class="text-primary fw-bold mt-5 mt-md-0">
                  {{ $t("mentee_profile_main.main") }}
                </span>
                <h4 class="text-primary fw-bold mb-4">
                  {{ profile.first_name }}
                  {{ profile.last_name }}
                </h4>
              </div>
              <div class="profile-img-shape">
                <div class="shape"></div>
                <div
                  class="file-upload-div d-flex justify-content-center align-items-center position-relative flex-column"
                >
                  <img
                    v-if="profile.image_view"
                    :src="profile.image_view"
                    width="80px"
                    height="80px"
                    @click="openFile"
                  />
                  <img
                    v-else
                    :src="`${
                      profile.image_path
                        ? url + profile.image_path
                        : '/assets/images/mentor-profile-img.png'
                    }`"
                    @click="openFile"
                    alt=""
                    class="img-fluid pt-3"
                  />
                  <div class="upload-btn-wrapper">
                    <button
                      class="btn btn-upload d-flex justify-content-center border-0 bg-transparent py-3"
                    >
                      <!-- Upload File -->
                      {{ $t("mentee_profile_main.picture") }}
                    </button>
                    <input
                      type="file"
                      id="picture"
                      ref="picture"
                      @change="processFile($event)"
                      name="picture"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <form
                action=""
                class="px-md-4 mt-md-0 mt-5"
                @submit="submitProfileInfo"
              >
                <div class="row">
                  <div class="col-lg-12 mb-4">
                    <toggle-button
                      v-model="profile.hide_visibility"
                      @change="onSVisibilityChangeEventHandler"
                      :color="{
                        checked: '#73bd49',
                        unchecked: '#6c757d',
                      }"
                    />
                    <label
                      class="form-check-label ms-2"
                      for="flexSwitchCheckDefault"
                    >
                      {{ $t("mentee_profile_main.visible") }}
                    </label>
                  </div>
                  <div class="col-lg-10"></div>
                  <div class="col-md-6 position-relative">
                    <label for="" class="text-primary mb-2">
                      {{ $t("mentee_profile_main.label_1") }}
                    </label>
                    <input
                      type="text"
                      placeholder="Enter your first name"
                      class="form-control border"
                      v-model="profile.first_name"
                      :class="
                        errors && errors.first_name ? 'border-danger' : ''
                      "
                    />
                    <p
                      v-if="errors && errors.first_name"
                      class="text-danger small position-absolute"
                    >
                      {{ errors.first_name[0] }}
                    </p>
                  </div>
                  <div class="col-md-6 position-relative">
                    <label for="" class="text-primary mb-2 mt-md-0 mt-4">
                      {{ $t("mentee_profile_main.label_2") }}
                    </label>
                    <input
                      type="text"
                      placeholder="Enter your last name"
                      class="form-control border"
                      v-model="profile.last_name"
                      :class="errors && errors.last_name ? 'border-danger' : ''"
                    />
                    <p
                      v-if="errors && errors.last_name"
                      class="text-danger small position-absolute"
                    >
                      {{ errors.last_name[0] }}
                    </p>
                  </div>

                  <div class="col-md-6 position-relative">
                    <label for="" class="text-primary mb-2 mt-4">
                      {{ $t("mentee_profile_main.label_6") }}
                    </label>
                    <input
                      type="text"
                      class="form-control border"
                      v-model="profile.email"
                      :class="errors && errors.email ? 'border-danger' : ''"
                    />
                    <p
                      v-if="errors && errors.email"
                      class="text-danger small position-absolute"
                    >
                      {{ errors.email[0] }}
                    </p>
                  </div>
                  <div class="col-md-6 position-relative">
                    <label for="" class="text-primary mb-2 mt-4">
                      {{ $t("mentee_profile_main.label_7") }}
                    </label>
                    <input
                      type="text"
                      class="form-control border"
                      v-model="profile.phone"
                      :class="errors && errors.phone ? 'border-danger' : ''"
                    />
                    <p
                      v-if="errors && errors.phone"
                      class="text-danger small position-absolute"
                    >
                      {{ errors.phone[0] }}
                    </p>
                  </div>
                  <div class="col-md-6 position-relative">
                    <label for="" class="text-primary mb-2 mt-4">
                      {{ $t("mentee_profile_main.label_3") }}
                    </label>
                    <div class="custom-select">
                      <select
                        class="form-select border"
                        aria-label="Default select example"
                        v-model="profile.gender"
                        :class="errors && errors.gender ? 'border-danger' : ''"
                      >
                        <option selected value="">
                          {{ $t("mentee_profile_main.label_31") }}
                        </option>
                        <option value="male">
                          {{ $t("mentee_profile_main.label_32") }}
                        </option>
                        <option value="female">
                          {{ $t("mentee_profile_main.label_33") }}
                        </option>
                      </select>
                      <p
                        v-if="errors && errors.gender"
                        class="text-danger small position-absolute"
                      >
                        {{ errors.gender[0] }}
                      </p>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label for="" class="text-primary mb-2 mt-4">
                      {{ $t("mentee_profile_main.label_4") }}
                    </label>
                    <div class="custom-select">
                      <select
                        class="form-select border"
                        aria-label="Default select example"
                        v-model="profile.country"
                        v-on:change="fetchStates()"
                        :class="errors && errors.country ? 'border-danger' : ''"
                      >
                        <option selected value="">Select Country</option>
                        <option
                          :value="country.id"
                          v-for="country in countries"
                          :key="country.id"
                        >
                          {{ country.name }}
                        </option>
                      </select>
                      <p
                        v-if="errors && errors.country"
                        class="text-danger small position-absolute"
                      >
                        {{ errors.country[0] }}
                      </p>
                    </div>
                  </div>
                  <div class="col-md-6 position-relative">
                    <label for="" class="text-primary mb-2 mt-4">
                      {{ $t("mentee_profile_main.label_8") }}
                    </label>
                    <div class="custom-select">
                      <select
                        class="form-select border"
                        aria-label="Default select example"
                        v-model="profile.state_id"
                        v-on:change="fetchCities(null)"
                        :class="
                          errors && errors.state_id ? 'border-danger' : ''
                        "
                      >
                        <option selected value="">Select State</option>
                        <option
                          v-for="state in states"
                          :value="state.id"
                          :key="state.id"
                        >
                          {{ state.name }}
                        </option>
                        >
                      </select>
                      <p
                        v-if="errors && errors.state_id"
                        class="text-danger small position-absolute"
                      >
                        {{ errors.state_id[0] }}
                      </p>
                    </div>
                  </div>
                  <div class="col-md-6 position-relative">
                    <label for="" class="text-primary mb-2 mt-4">
                      {{ $t("mentee_profile_main.label_5") }}
                    </label>
                    <div class="custom-select">
                      <select
                        class="form-select border"
                        aria-label="Default select example"
                        v-model="profile.city"
                        :class="errors && errors.city ? 'border-danger' : ''"
                      >
                        <option selected value="">Select City</option>
                        <option
                          :value="city.name"
                          v-for="city in cities"
                          :key="city.id"
                        >
                          {{ city.name }}
                        </option>
                        >
                      </select>
                      <p
                        v-if="errors && errors.city"
                        class="text-danger small position-absolute"
                      >
                        {{ errors.city[0] }}
                      </p>
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-end mt-5">
                  <button
                    class="btn btn-secondary px-4 text-white"
                    type="submit"
                  >
                    {{ $t("mentee_profile_main.button") }}

                    <i class="fa-solid fa-angles-right ms-1"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import loginMixin from "../mixins/loginMixin.js";
export default {
  props: ["url"],
  mixins: [loginMixin],

  data() {
    return {
      loading: true,
      errors: {},
      profile: {
        first_name: "",
        last_name: "",
        email: "",
        phone: "",
        gender: "",
        country: "",
        state_id: "",
        city: "",
        picture: {},
        image_view: "",
        image_path: "",
        token: 123,
        hide_visibility: true,
      },
      countries: {},
      cities: {},
      states: {},
      mentee_id: "",
    };
  },
  methods: {
    openFile() {
      if (this.profile.image_path) {
        let image = this.url + this.profile.image_path;
        window.open(image, "_blank");
      } else {
        window.open(this.profile.image_view, "_blank");
      }
    },
    async onSVisibilityChangeEventHandler() {
      var self = this;
      var toast = this.$toasted;
      if (this.profile.hide_visibility) {
        var params = {
          token: 123,
          visibility: 1,
          user_id: this.User.user_id,
        };
      } else {
        var params = {
          token: 123,
          visibility: 0,
          user_id: this.User.user_id,
        };
      }
      const res = await axios
        .post("/api/toggle-visibility", params)
        .then((res) => {
          if (res.data.Status) {
            toast.success(res.data.msg);
          }
          if (!res.data.Status) {
            toast.error(res.data.msg);
          }
        });
    },
    async fatchUserData() {
      const params = {
        token: 123,
        user_id: this.User.user_id,
      };
      const res = await axios.get("/api/getUserById", {
        params,
      });
      if (res.data && res.data.Status) {
        this.profile.first_name = res.data.data.userDetail.first_name
          ? res.data.data.userDetail.first_name
          : "";
        this.profile.email = res.data.data.userDetail.email
          ? res.data.data.userDetail.email
          : "";
        this.profile.phone = res.data.data.userDetail.phone
          ? res.data.data.userDetail.phone
          : "";
        this.profile.last_name = res.data.data.userDetail.last_name
          ? res.data.data.userDetail.last_name
          : "";

        this.profile.gender = res.data.data.userDetail.gender
          ? res.data.data.userDetail.gender
          : "";

        this.profile.country = res.data.data.userDetail.country
          ? res.data.data.userDetail.country
          : "";
        this.profile.state_id = res.data.data.userDetail.state_id
          ? res.data.data.userDetail.state_id
          : "";
        this.profile.city = res.data.data.userDetail.city
          ? res.data.data.userDetail.city
          : "";
        this.profile.image_path = res.data.data.userDetail.image_path
          ? res.data.data.userDetail.image_path
          : "";

        this.loading = false;
      }
    },
    async fetchCountries() {
      const params = {
        token: 123,
      };
      const res = await axios.get("/api/countries", {
        params,
      });
      if (res.data && res.data.Status) {
        this.countries = res.data.data.countries;
      }
      if (this.profile.country) {
        this.fetchMountedCities(this.profile.country);
      }
    },
    async fetchStates() {
      var country_id = this.profile.country;

      const params = {
        token: 123,
        country_id: country_id,
      };
      const res = await axios.get("/api/states", {
        params,
      });
      if (res.data && res.data.Status) {
        this.states = res.data.data.states;
      }
    },
    async fetchCities(city_param) {
      var state_id = this.profile.state_id;
      const params = {
        token: 123,
        state_id: state_id,
      };
      const res = await axios.get("/api/cities", {
        params,
      });
      if (res.data && res.data.Status) {
        this.cities = res.data.data.cities;

        if (!this.profile.city) {
          this.cities.forEach((cityElement) => {
            if (cityElement.name == city_param) {
              this.profile.city = cityElement.name;
            }
          });
        }
      }
    },
    async fetchMountedCities(event) {
      var country_id = event;

      const params = {
        token: 123,
        country_id: country_id,
      };
      const res = await axios.get("/api/cities", {
        params,
      });
      if (res.data && res.data.Status) {
        this.cities = res.data.data.cities;
      }
    },

    processFile(event) {
      this.profile.picture = event.target.files[0];
      this.profile.image_view = URL.createObjectURL(event.target.files[0]);
    },
    async submitProfileInfo(e) {
      if (this.profile.address == "") {
        this.profile.address = document.getElementById("map").value;
      }
      var self = this;
      var toast = this.$toasted;
      e.preventDefault();
      const headers = {
        "Content-Type": "multipart/form-data",
      };

      let formData = new FormData();
      formData.append("picture", this.profile.picture);
      formData.append("token", this.profile.token);
      formData.append("user_id", this.User.user_id);
      formData.append("first_name", this.profile.first_name);
      formData.append("last_name", this.profile.last_name);
      formData.append("gender", this.profile.gender);
      formData.append("state_id", this.profile.state_id);
      formData.append("email", this.profile.email);
      formData.append("phone", this.profile.phone);

      formData.append("country", this.profile.country);
      formData.append("city", this.profile.city);
      this.errors = {};
      const res = await axios
        .post("/api/update-mentee-profile", formData, {
          headers: headers,
        })
        .then((res) => {
          if (res.data.Status) {
            localStorage.setItem("menteeProfileCompleted", JSON.stringify(1));
            toast.success(res.data.msg);
            if (document.referrer) window.location.href = document.referrer;
            // document.getElementById("nav-profile-tab").click();
          }
          if (!res.data.Status) {
            for (const property in res.data.errors) {
              //   this.$toasted.error(res.data.errors[property][0]);
              this.errors = res.data.errors;
            }
          }
        });
    },
    success(pos) {
      const crd = pos.coords;
      //   console.log(`Latitude : ${crd.latitude}`);
      //   console.log(`Longitude: ${crd.longitude}`);

      const geocoder = new google.maps.Geocoder();
      const latlng = {
        lat: parseFloat(crd.latitude),
        lng: parseFloat(crd.longitude),
      };
      geocoder.geocode(
        {
          location: latlng,
        },
        (results, status) => {
          if (status === "OK") {
            if (results[0]) {
              var address = results[0].formatted_address;
            } else {
              console.log("No results found");
            }
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
                    c = 0, lc = result.address_components.length;
                    c < lc;
                    c += 1
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
                    c = 0, lc = result.address_components.length;
                    c < lc;
                    c += 1
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

              if (!this.profile.country) {
                this.countries.forEach((element) => {
                  if (element.iso_code_2 == countryCode) {
                    this.profile.country = element.id;
                    this.fetchStates();
                  }
                });
              }
            }
          } else {
            console.log("Geocoder failed due to: " + status);
          }
        }
      );
    },
    error(err) {
      console.warn(`ERROR(${err.code}): ${err.message}`);
    },
  },
  created() {
    this.checkLoggedIn();
    this.mentee_id = this.User.user_id;
  },
  async mounted() {
    if (this.is_loggedIn && this.User.role == "Mentee") {
    } else {
      window.location.href = this.url + "/login";
      this.$toasted.error("Please Login First");
    }
    await this.fatchUserData();
    await this.fetchCountries();
  const options = {
      enableHighAccuracy: true,
      timeout: 5000,
      maximumAge: 0,
    };
   await navigator.geolocation.getCurrentPosition(this.success, this.error, options);
    if (this.profile.country) {
      await this.fetchStates();
    }
    if (this.profile.state_id) {
      await this.fetchCities(null);
    }
  },
};
</script>
