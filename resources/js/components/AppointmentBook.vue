<template>
  <div class="row bg-white p-3 border-radius">
    <div class="col-md-12" v-if="showAppointmentSection">
      <span class="text-primary mt-5 mt-md-0 h5">{{
        $t("book_appointment.ask_ques")
      }}</span>
      <span class="h6 text-primary mt-5 mt-md-0"
        >({{ $t("book_appointment.question.text_placeholder") }})
      </span>

      <div class="form-ask">
        <form @submit="submitForm" enctype="multipart/form-data">
          <!-- <img v-if="formData.image_view" :src="formData.image_view" height="80px" width="80px" class="mt-2"
                        @click="openFile" /> -->
          <textarea
            name=""
            id=""
            rows="5"
            class="form-control w-100 border p-2 mt-3"
            placeholder="Enter here"
            v-model="formData.questions"
            :class="errors && errors.questions ? 'border-danger' : ''"
          ></textarea>
          <p v-if="errors && errors.questions" class="text-danger">
            {{ errors.questions[0] }}
          </p>
          <i
            class="fas fa-trash text-danger ms-3"
            v-if="formData.image_view"
            @click="removeImage"
          ></i>
          <div class="upload-btn-wrapper w-100 mt-3">
            <!-- <button class="btn btn-upload w-100 d-flex">
                            <span v-if="formData.file_name"> {{ formData.file_name }}</span>
                            <span v-else>Upload a file</span>
                        </button> -->
            <!-- <input type="file" id="book_file" ref="book_file" @change="processFile($event)"
                            name="book_file" /> -->
            <vue-dropzone
              ref="myVueDropzone"
              id="dropzone"
              :options="dropzoneOptions"
              @vdropzone-success="serverResponse"
            ></vue-dropzone>
          </div>

          <br />
          <div
            class="form-group"
            v-if="type == 'on-site' || type == 'home-visit'"
          >
            <input
              type="text"
              v-model="formData.inspection_address"
              class="form-control"
              :placeholder="$t('book_appointment.address.text_placeholder')"
            />
            <p v-if="errors && errors.inspection_address" class="text-danger">
              {{ errors.inspection_address[0] }}
            </p>
          </div>
          <div class="table-responsive mt-5">
            <table class="table" v-if="dropZoneUploadedFiles.length">
              <thead>
                <tr class="bg-tr text-white fw-400">
                  <th scope="col" class="fw-400">#</th>
                  <th scope="col" class="fw-400">Name</th>
                  <th scope="col" class="fw-400">Description</th>
                  <th scope="col" class="fw-400">Size</th>
                  <th scope="col" class="fw-400">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(file, index) in dropZoneUploadedFiles" :key="index">
                  <th scope="row">{{ index + 1 }}</th>
                  <td>
                    <a target="_blank" :href="file.url">{{
                      file.name
                    }}</a>
                  </td>
                  <td>
                    <div class="form-group">
                      <input
                        type="text"
                        v-model="file.description"
                        class="form-control"
                        name=""
                        id=""
                      />
                    </div>
                  </td>
                  <td>{{ file.size.toFixed(2) }} Kb</td>
                  <td>
                    <button
                      type="button"
                      class="btn btn-danger"
                      @click="deleteMedia(file.id, index)"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="d-flex pt-4 justify-content-end align-items-center">
            <button
              class="btn btn-graish me-2 text-white"
              @click="$emit('cancelAppointment')"
            >
              <i class="fa-solid fa-angles-left me-1"></i>
              {{ $t("book_appointment.question.btn_back") }}
            </button>
            <button
              class="btn btn-primary me-2 text-uppercase"
              v-if="appointmentid"
              type="submit"
            >
              {{ $t("book_appointment.question.btn_update") }}
              <i class="fa-solid fa-angles-right me-1"></i>
            </button>

            <button v-else class="btn btn-secondary text-white" type="submit">
              {{ $t("book_appointment.question.btn_submit") }}
              <i class="fa-solid fa-angles-right ms-1"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-md-12" v-if="showPayment && !loading">
      <h5 class="text-primary mt-lg-0 mt-5">
        {{ $t("book_appointment.payment_method") }}
      </h5>
      <div class="payment-card mt-3">
        <ul
          class="d-inline-flex flex-wrap ps-0"
          type="none"
          v-if="payment_methods.length > 0"
        >
          <li v-for="pm in payment_methods" class="pe-2 mb-2">
            <div
              class="card border-0 d-md-flex h-100 bg-transparent align-items-center justify-content-center border-0"
            >
              <label class="h-100">
                <input type="radio" v-model="payment_method" :value="pm.code" />
                <img :src="`${url + '/' + pm.image_path}`"
              /></label>
            </div>
          </li>

          <li class="mb-2">
            <div
              class="card border-0 bg-transparent d-md-flex h-100 align-items-center justify-content-center"
            >
              <label class="h-100">
                <input
                  type="radio"
                  v-model="payment_method"
                  name="payment_method"
                  value="wallet"
                />
                <img src="/assets/images/wallet.png" alt="" class="img-fluid" />
              </label>
            </div>
          </li>
        </ul>
      </div>
      <div class="form-card" v-if="payment_method == 'jazzcash'">
        <h6 class="text-dark pt-3 fs-5 mb-4">
          {{ $t("book_appointment.mobile_detail") }}
        </h6>
        <label for="" class="mb-2 fw-500 text-dark"
          >Jazzcash Mobile Number<span class="text-danger">*</span></label
        >
        <input
          class="form-control py-2 mb-3"
          type="number"
          placeholder=""
          v-model="jazzcash.mobile_no"
          aria-label="default input example"
        />
        <label for="" class="mb-2 fw-500 text-dark"
          >Last 6 Digit of CNIC <span class="text-danger">*</span></label
        >
        <input
          class="form-control py-2 mb-3"
          type="number"
          placeholder=""
          maxlength="6"
          v-model="jazzcash.cnic_digit"
        />
      </div>
      <div class="form-card" v-if="payment_method == 'paytm'">
        <h6 class="text-dark pt-3 fs-5 mb-4">
          {{ $t("book_appointment.mobile_detail") }}
        </h6>
        <label for="" class="mb-2 fw-500 text-dark">
          Mobile Number<span class="text-danger">*</span></label
        >
        <input
          class="form-control py-2 mb-3"
          type="number"
          placeholder=""
          v-model="paytm.mobile_no"
          aria-label="default input example"
        />
        <label for="" class="mb-2 fw-500 text-dark">
          Email<span class="text-danger">*</span></label
        >
        <input
          class="form-control py-2 mb-3"
          type="text"
          placeholder=""
          v-model="paytm.email"
        />
      </div>
      <div
        class="form-card"
        v-if="
          payment_method &&
          payment_method != 'wallet' &&
          payment_method != 'wave' &&
          payment_method != 'jazzcash' &&
          payment_method != 'easypaisa' &&
          payment_method != 'paytm' &&
          payment_method != 'razorpay' &&
          payment_method != 'flutterwave'
        "
      >
        <h6 class="text-dark pt-3 fs-5 mb-4">
          {{ $t("book_appointment.card_detail") }}
        </h6>
        <label for="" class="mb-2 fw-500 text-dark"
          >Card Holder Name<span class="text-danger">*</span></label
        >
        <input
          type="text"
          name=""
          id=""
          class="form-control border mb-3"
          placeholder=""
        />
        <label for="" class="mb-2 fw-500 text-dark"
          >Card Number<span class="text-danger">*</span></label
        >
        <input
          type="number"
          name=""
          v-model="payment_details.card_number"
          id=""
          class="form-control border mb-3"
          placeholder=""
        />

        <div class="row">
          <div class="col-md-4">
            <label for="" class="mb-2 fw-500 text-dark">
              Year<span class="text-danger">*</span></label
            >
            <datetime
              input-class="form-control border mb-3"
              type="date"
              :flow="['year']"
              :format="'yy'"
              placeholder=""
              v-model="payment_details.exp_year"
            ></datetime>
          </div>
          <div class="col-md-4">
            <label for="" class="mb-2 fw-500 text-dark"
              >Month<span class="text-danger">*</span></label
            >
            <datetime
              input-class="form-control border mb-3"
              type="date"
              :flow="['month']"
              :format="'MM'"
              placeholder=""
              v-model="payment_details.exp_month"
            ></datetime>
          </div>
          <div class="col-md-4">
            <label for="" class="mb-2 fw-500 text-dark"
              >CVV Code<span class="text-danger">*</span></label
            >
            <input
              type="number"
              name=""
              id=""
              class="form-control border mb-3"
              placeholder=""
              v-model="payment_details.cvc"
            />
          </div>
        </div>
      </div>
      <vue-recaptcha
        :sitekey="google_capcha_site_key"
        @verify="onVerify"
        @expired="onExpired"
        :loadRecaptchaScript="true"
        ref="recaptcha"
        class="w-100"
      ></vue-recaptcha>
      <div class="d-flex pt-4 justify-content-end align-items-center">
        <button
          class="btn btn-graish me-2 text-white"
          @click="$emit('cancelAppointment')"
        >
          <i class="fa-solid fa-angles-left me-1"></i>
          {{ $t("book_appointment.back") }}
        </button>
        <!-- data-bs-toggle="modal"
          data-bs-target="#exampleModal" -->
        <button
          class="btn btn-secondary text-white"
          @click="makePayment"
          :disabled="!recaptchaVerified"
        >
          {{ $t("book_appointment.make_payment.label") }}
          <i class="fa-solid fa-angles-right ms-1"></i>
        </button>
      </div>
    </div>
    <div class="col-md-12 ps-4 text-center" v-if="loading">
      <img src="/assets/images/logo.png" height="20px" alt="" />
    </div>
  </div>
</template>
<script>
import loginMixin from "../mixins/loginMixin.js";
import VueRecaptcha from "vue-recaptcha";
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
export default {
  props: [
    "url",
    "selected_new_date",
    "type",
    "appointment_id",
    "appointment_fee",
    "user_selected_slot",
    "user_selected_slot_endtime",
    "mentor_id",
    "mentor_number",
    "route",
    "appointmentid",
    "google_capcha_site_key",
  ],
  mixins: [loginMixin],
  components: {
    VueRecaptcha,
    vueDropzone: vue2Dropzone,
  },
  data() {
    return {
      formData: {
        token: 123,
        mentee_id: "",
        mentor_id: this.mentor_id,
        payment: this.appointment_fee,
        payment_id: 1,
        book_file: {},
        questions: "",
        inspection_address: "",
        image_view: "",
        file_name: "",
        file_type: "",
      },
      payment_details: {
        card_number: "",
        exp_month: "",
        exp_year: "",
        cvc: "",
      },
      jazzcash: {
        mobile_no: "",
        cnic_digit: "",
      },
      paytm: {
        mobile_no: "",
        email: "",
      },
      payment_method: "",
      appointmentNo: "",
      old_appointment: "",
      loading: false,
      showPayment: false,
      showAppointmentSection: true,
      errors: {},
      payment_methods: [],
      recaptchaVerified: false,
      dropzoneOptions: {
        url: "/api/upload_dropzone_images",
        thumbnailWidth: 150,
        maxFilesize: 2,
        parallelUploads: 1,
        // maxFiles: 3,
        uploadMultiple: true,
        autoProcessQueue: true,
      },
      dropZoneUploadedFiles: [],
    };
  },
  methods: {
    async fetchAppointmentDetails() {
      var params = {
        token: 123,
        appointment_id: this.appointmentid,
        user_id: this.User.user_id,
      };
      var toast = this.$toasted;
      const res = await axios
        .get("/api/appointmentDetails", { params })
        .then((res) => {
          if (res.data.Status) {
            this.loading = false;
            this.formData.questions = res.data.data.appointment.questions;
            this.formData.inspection_address =
              res.data.data.appointment.inspection_address;
            this.formData.book_file = res.data.data.appointment.file;
            this.formData.file_type = res.data.data.appointment.file_type;
            this.formData.payment = res.data.data.appointment.payment;
          }
          if (!res.data.Status) {
            this.loading = false;
          }
        });
    },
    removeImage() {
      this.formData.image_view = "";
      this.formData.file_name = "";
    },
    processFile(event) {
      this.formData.book_file = event.target.files[0];
      if (event.target.files[0].type.includes("image")) {
        this.formData.image_view = URL.createObjectURL(event.target.files[0]);
        this.formData.file_name = event.target.files[0].name;
      } else {
        this.formData.image_view = "";
        this.formData.file_name = event.target.files[0].name;
      }
    },
    openFile() {
      window.open(this.formData.image_view, "_blank");
    },
    async submitForm(e) {
      var self = this;
      var toast = this.$toasted;
      e.preventDefault();

      if (
        (this.type == "on-site" && !this.formData.inspection_address) ||
        (this.type == "home-visit" && !this.formData.inspection_address)
      ) {
        toast.error("The inspection address field is required");
        return;
      }

      const params = {
        token: this.formData.token,
        mentee_id: this.formData.mentee_id,
        mentor_id: this.formData.mentor_id,
        payment: this.formData.payment,
        payment_id: this.formData.payment_id,
        questions: this.formData.questions,
        inspection_address: this.formData.inspection_address,
        type: "question",
        appointment_type_string: this.type,
        appointment_type_id: this.appointment_id,
        date: this.selected_new_date,
        time: this.user_selected_slot,
        end_time: this.user_selected_slot_endtime,
        bookAppointmentId: this.appointmentid,
        uploadedMediaDetails: this.dropZoneUploadedFiles,
      };

      const res = await axios
        .post("/api/bookAppointment", params)
        .then((res) => {
          if (res.data.Status) {
            toast.success(res.data.msg);
            self.appointmentNo = res.data.data.appointmentNo;
            self.sendBookedAppointmentNotification();
            self.sendBookedAppointmentSms();
            if (this.appointmentid) {
              this.showPayment = false;
              this.showAppointmentSection = true;
              window.location.href = this.url + "/mentee/appointment-log";
            } else {
              this.showPayment = true;
              this.showAppointmentSection = false;
              this.fetchPaymentMethods();
            }
            $("#exampleModalToggle2").modal("show");
            self.formData.questions = [];
            self.formData.book_file = {};
            $("#book_file").val("");
          }
          if (!res.data.Status) {
            // toast.error(res.data.errors.questions[0]);
            this.errors = res.data.errors;
          }
        });
    },
    async makePayment() {
      var toast = this.$toasted;
      // this.loading = true;
      let total = this.appointment_fee;
      let appointmentID = this.appointmentNo;
      let expMonth = new Date(this.payment_details.exp_month).getUTCMonth() + 1;
      if (expMonth.toString().length == 1) {
        expMonth = "0" + expMonth;
      }
      let body = {
        mentee_id: this.formData.mentee_id,
        total: total,
        payment_method_code: this.payment_method,
        cardInfo: {
          number: this.payment_details.card_number,
          exp_month: expMonth,
          exp_year: new Date(this.payment_details.exp_year).getFullYear(),
          cvc: this.payment_details.cvc,
        },

        shipping_address: {
          id: "",
          first_name: "shahzad",
          last_name: "Tariq",
          email: "fharshad842@gmail.com",
          city_id: 85335,
          state_id: 3176,
          country_id: 167,
          zip_code: "38000",
          address:
            "Bismillah General Store Back Saira Mall Plaza Dogar Basti\nPeople Colony # 1 D Ground Faisalabad",
          phone: "034677992777",
        },
        shipping_id: 1,
        plateForm: "web",
        paytm_mode: "",
        bookAppointmentId: appointmentID,
      };
      const headers = {
        Accept: "application/json",
        "Content-Type": "application/json",
      };
      if (this.payment_method == "paytm") {
        this.paymentLoading = true;
        var self = this;
        var toast = this.$toasted;

        window.location.href =
          this.route +
          "/" +
          appointmentID +
          "/" +
          this.paytm.mobile_no +
          "/" +
          this.paytm.email;
      }
      if (this.payment_method == "jazzcash") {
        this.paymentLoading = true;
        var self = this;
        var toast = this.$toasted;
        var params = {
          token: 123,
          mobile_no: this.jazzcash.mobile_no,
          cnic: this.jazzcash.cnic_digit,
          amount: total,
          bookAppointmentId: appointmentID,
          mobile_account: 1,
        };
        const res = await axios
          .post("/api/makeJazzcashPayment", params)
          .then((res) => {
            if (res.data.Status) {
              this.loading = false;
              toast.success(res.data.msg);
              window.location.href = "/mentee/appointment-log";
            }
            if (!res.data.Status) {
              this.loading = false;
              toast.error(res.data.msg);
            }
            if (res.data.errors) {
              this.loading = false;
              for (const property in res.data.errors) {
                toast.error(res.data.errors[property][0]);
              }
            }
          });
      }
      if (this.payment_method == "easypaisa") {
        window.open(
          "/easypaisa?amount=" +
            this.formData.payment +
            "&bookAppointmentId=" +
            this.appointmentNo,
          "_blank"
        );
        this.loading = false;
        window.location.href = "/mentee/appointment-log";
      }
      if (this.payment_method == "flutterwave") {
        let base_url = window.location.origin;
        window.location =
          "/pay?bookAppointmentId=" +
          appointmentID +
          "&total=" +
          total +
          "&mentee_id=" +
          this.formData.mentee_id;
      } else if (this.payment_method == "razorpay") {
        const res = await axios
          .post("/api/execute-payment", body, {
            headers: headers,
          })
          .then((res) => {
            if (res.data.status == 400) {
              toast.error(res.data.data.message);
            }
            if (res.data.original && res.data.original.Status) {
              toast.success(res.data.original.msg);
              this.loading = false;
              window.location = "/mentee/appointment-log";
            } else if (!res.data.Status) {
              window.location = res.data.authorization_url;
            }
          })
          .catch((error) => {
            if (error.response) {
              for (const property in error.response.data.errors) {
                toast.error(error.response.data.errors[property]);
              }
            }
          });
      } else if (this.payment_method == "stripe") {
        const res = await axios
          .post("/api/execute-payment", body, {
            headers: headers,
          })
          .then((res) => {
            if (res.data.status == 400) {
              toast.error(res.data.data.message);
            }
            if (res.data.original && res.data.original.Status) {
              toast.success(res.data.original.msg);
              this.loading = false;
              window.location = "/mentee/appointment-log";
            } else if (!res.data.Status && res.data.authorization_url) {
              window.location = res.data.authorization_url;
            }
          })
          .catch((error) => {
            if (error.response) {
              for (const property in error.response.data.errors) {
                toast.error(error.response.data.errors[property]);
              }
            }
          });
      } else if (this.payment_method == "wallet") {
        var self = this;

        var params = {
          token: 123,
          from_user_id: this.User.user_id,
          to_user_id: this.mentor_id,
          amount: total,
          bookAppointmentId: appointmentID,
        };
        const res = await axios
          .post("/api/wallet-credit-transfer", params)
          .then((res) => {
            if (res.data.Status) {
              this.loading = false;
              toast.success(res.data.msg);
              window.location.href = "/mentee/appointment-log";
            }
            if (!res.data.Status) {
              this.loading = false;
              toast.error(res.data.msg);
            }
          });
      } else if (this.payment_method == "braintree") {
        const res = await axios
          .post("/api/execute-payment", body, {
            headers: headers,
          })
          .then((res) => {
            if (res.data.status == 400) {
              toast.error(res.data.data.message);
            }
            if (res.data.original && res.data.original.Status) {
              toast.success(res.data.original.msg);
              this.loading = false;
              window.location = "/mentee/appointment-log";
            }
          })
          .catch((error) => {
            if (error.response) {
              for (const property in error.response.data.errors) {
                toast.error(error.response.data.errors[property]);
              }
            }
          });
      } else if (this.payment_method == "paypal") {
        const res = await axios
          .post("/api/execute-payment", body, {
            headers: headers,
          })
          .then((res) => {
            if (res.data.status == 400) {
              toast.error(res.data.data.message);
            }
            if (res.data.original && res.data.original.Status) {
              toast.success(res.data.original.msg);
              this.loading = false;
              window.location = "/mentee/appointment-log";
            } else if (!res.data.Status) {
              localStorage.setItem("appointmentID", this.appointmentNo);
              window.location = res.data.authorization_url;
            }
          })
          .catch((error) => {
            if (error.response) {
              for (const property in error.response.data.errors) {
                toast.error(error.response.data.errors[property]);
              }
            }
          });
      }
    },
    async sendBookedAppointmentNotification() {
      const params = {
        token: 123,
        user_id: this.mentor_id,
        body: "Click here to See your Appointment",
        title: "New Appointment for You.",
        link: "/mentor/appointment-log/",
      };
      const res = await axios
        .post("/api/send-web-notification", params)
        .then((res) => {});
    },
    async sendBookedAppointmentSms() {
      const params = {
        token: 123,
        phone: this.mentor_number,
        message: "New Appointment for You.",
      };
      const res = await axios.post("/api/send-sms", params).then((res) => {});
    },
    async fetchPaymentMethods() {
      this.loading = true;
      const res = await axios.get("/api/payment_methods", {
        params: { token: 123, platform: "web" },
      });
      if (res.data) {
        this.payment_methods = res.data.data;
        if (this.payment_methods.length > 0) {
            this.payment_methods.forEach((payment_method,index) => {
                if (index == 0) {
                    this.payment_method = payment_method.code
                }
            });
        }
        this.loading = false;
      }
      // else{
      //     toast.error(res.data.errors);
      // }
    },
    onSubmit: function () {
      this.$refs.invisibleRecaptcha.execute();
    },
    onVerify: function (response) {
      this.recaptchaVerified = true;
    },
    onExpired: function () {
      this.recaptchaVerified = false;
    },
    resetRecaptcha() {
      this.$refs.recaptcha.reset(); // Direct call reset method
    },
    serverResponse: async function (files, response) {
      if (response.Status) {
        this.dropZoneUploadedFiles.push(response.data.file_details);
        this.$refs.myVueDropzone.removeFile(files);
      } else {
      }
    },
    async deleteMedia(media_id, index) {
      var self = this;
      var toast = this.$toasted;
      var params = {
        token: 123,
        media_id: media_id,
      };
      const res = await axios
        .get("/api/delete_media_file", { params })
        .then((res) => {
          if (res.data.Status) {
            toast.success(res.data.msg);
            this.dropZoneUploadedFiles.splice(index, 1);
          }
        });
    },
  },
  created() {
    this.checkLoggedIn();
    if (this.is_loggedIn && this.User.role == "Mentee") {
    } else if (this.is_loggedIn && this.User.role == "Mentor") {
      this.$toasted.error("Please Login as a User");
    } else {
      window.location.href = this.url + "/login";
      this.$toasted.error("Please Login First");
    }
    if (this.appointmentid) {
      this.fetchAppointmentDetails();
    }
  },
  mounted() {
    this.formData.mentee_id = this.User.user_id;
  },
};
</script>
