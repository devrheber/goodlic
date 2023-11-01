<template>
  <section class="signup pt-0 pb-0">
    <div class="container-fluid pe-md-0">
      <div class="row mx-0">
        <div class="col-sm-12 col-md-6">
          <div
            class="h-100 d-flex justify-content-center align-content-center flex-column signup-section py-5"
          >
            <a href="/"><img :src="url + logo" class="logo" alt="" /></a>

            <h1 class="fw-bold my-4 text-primary">
              {{ $t("signup_form_section.label_9") }}
              <img src="/assets/images/arrow.png" alt="" class="ps-3" />
            </h1>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link active me-3 mt-md-0 mt-2"
                  id="pills-home-tab"
                  data-bs-toggle="pill"
                  data-bs-target="#pills-home"
                  type="button"
                  role="tab"
                  aria-controls="pills-home"
                  aria-selected="true"
                  @click="changeRole('Mentee')"
                >
                  {{ $t("signup_form_section.button_1") }}
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link mt-md-0 mt-2"
                  id="pills-profile-tab"
                  data-bs-toggle="pill"
                  data-bs-target="#pills-profile"
                  type="button"
                  role="tab"
                  aria-controls="pills-profile"
                  aria-selected="false"
                  @click="changeRole('Mentor')"
                >
                  {{ $t("signup_form_section.button_2") }}
                </button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div
                class="tab-pane fade show active"
                id="pills-home"
                role="tabpanel"
                aria-labelledby="pills-home-tab"
              >
                <input type="hidden" id="mentee_fbId" />
                <div class="form-signup">
                  <div class="login-email" v-if="login_type == 'email'">
                    <div class="row">
                      <div class="col-lg-6">
                        <input
                          type="text"
                          name="mentee_first_name"
                          id="mentee_first_name"
                          :placeholder="$t('signup_form_section.label_1')"
                          class="form-control mt-4"
                          :class="
                            mentee_errors && mentee_errors.first_name
                              ? 'border-danger'
                              : ''
                          "
                        />
                        <p
                          v-if="mentee_errors && mentee_errors.first_name"
                          class="text-danger small"
                        >
                          {{ mentee_errors.first_name[0] }}
                        </p>
                      </div>
                      <div class="col-lg-6">
                        <input
                          type="text"
                          name="mentee_last_name"
                          id="mentee_last_name"
                          :placeholder="$t('signup_form_section.label_2')"
                          class="form-control mt-4"
                          :class="
                            mentee_errors && mentee_errors.last_name
                              ? 'border-danger'
                              : ''
                          "
                        />
                        <p
                          v-if="mentee_errors && mentee_errors.last_name"
                          class="text-danger small"
                        >
                          {{ mentee_errors.last_name[0] }}
                        </p>
                      </div>
                    </div>

                    <input
                      type="email"
                      name="mentee_email"
                      id="mentee_email"
                      :placeholder="$t('signup_form_section.label_3')"
                      class="form-control mt-4"
                      :class="
                        mentee_errors && mentee_errors.email
                          ? 'border-danger'
                          : ''
                      "
                    />
                    <p
                      v-if="mentee_errors && mentee_errors.email"
                      class="text-danger small"
                    >
                      {{ mentee_errors.email[0] }}
                    </p>
                    <div class="position-relative">
                      <input
                        :type="type"
                        name="mentee_password"
                        id="mentee_password"
                        :placeholder="$t('signup_form_section.label_4')"
                        class="form-control mt-4"
                        :class="
                          mentee_errors && mentee_errors.password
                            ? 'border-danger'
                            : ''
                        "
                      />
                      <a v-if="icon == 'show'" href="javascript:void(0)">
                        <i
                          class="fa-solid fa-eye position-absolute"
                          id="togglePassword"
                          @click="showPassword"
                        ></i>
                      </a>
                      <a v-if="icon == 'hide'" href="javascript:void(0)">
                        <i
                          class="fa-solid fa-eye-slash position-absolute"
                          id="togglePassword"
                          @click="showPassword"
                        ></i>
                      </a>
                      <p
                        v-if="mentee_errors && mentee_errors.password"
                        class="text-danger small"
                      >
                        {{ mentee_errors.password[0] }}
                      </p>
                    </div>
                    <div class="position-relative">
                      <input
                        :type="type"
                        name="mentee_confirm_password"
                        id="mentee_confirm_password"
                        :placeholder="$t('signup_form_section.label_5')"
                        class="form-control mt-4"
                        :class="
                          mentee_errors && mentee_errors.password
                            ? 'border-danger'
                            : ''
                        "
                      />
                      <a v-if="c_icon == 'show'" href="javascript:void(0)">
                        <i
                          class="fa-solid fa-eye position-absolute"
                          id="togglePassword"
                          @click="showConfirmPassword"
                        ></i>
                      </a>
                      <a v-if="c_icon == 'hide'" href="javascript:void(0)">
                        <i
                          class="fa-solid fa-eye-slash position-absolute"
                          id="togglePassword"
                          @click="showConfirmPassword"
                        ></i>
                      </a>
                    </div>
                    <div
                      class="form-check mb-2 mt-3 col-12 d-flex align-items-center"
                    >
                      <input
                        type="checkbox"
                        v-model="mentee_condition"
                        class="form-check-input"
                        id="mentor_condition"
                      />
                      <label
                        class="form-check-label ms-2"
                        for="mentor_condition"
                        ><a
                          data-bs-toggle="modal"
                          data-bs-target="#exampleModal"
                          href="javascript:void(0)"
                          >Agree with our terms & conditions</a
                        ></label
                      >
                    </div>
                    <button
                      class="btn btn-secondary text-white w-100 mt-5"
                      @click="registerMentee()"
                    >
                      {{ $t("signup_form_section.button_3") }}
                    </button>
                  </div>
                  <div class="login-phone" v-if="login_type == 'phone'">
                    <div class="mt-4 mb-3">
                      <label for="" class="mb-2 text-dark fw-500"
                        >Mobile<span class="text-danger">*</span></label
                      >
                      <input
                        type="tel"
                        :disabled="disabled"
                        v-model="mentee_number"
                        class="form-control mt-2"
                        placeholder=""
                        id="mentee_tel"
                      />

                      <input type="hidden" name="" id="result" />

                      <div class="mt-4" id="recaptcha-container-mentee"></div>
                    </div>

                    <div class="opt-section mt-4" v-if="showMenteeOtp">
                      <h5 class="underline mb-3">
                        {{ $t("login.mentor.enter_otp") }}
                      </h5>
                      <div class="d-flex otp flex-wrap flex-row">
                        <input
                          type="text"
                          v-model="mentee.val1"
                          maxLength="1"
                          id="1"
                          min="0"
                          max="9"
                          class="form-control mb-3"
                        />
                        <input
                          v-model="mentee.val2"
                          type="text"
                          maxLength="1"
                          id="2"
                          min="0"
                          max="9"
                          class="form-control mb-3"
                        />
                        <input
                          v-model="mentee.val3"
                          type="text"
                          id="3"
                          maxLength="1"
                          min="0"
                          max="9"
                          class="form-control mb-3"
                        />
                        <input
                          v-model="mentee.val4"
                          type="text"
                          maxLength="1"
                          id="4"
                          min="0"
                          max="9"
                          class="form-control mb-3"
                        />
                        <input
                          v-model="mentee.val5"
                          type="text"
                          maxLength="1"
                          id="5"
                          min="0"
                          max="9"
                          class="form-control mb-3"
                        />
                        <input
                          v-model="mentee.val6"
                          type="text"
                          maxLength="1"
                          id="6"
                          min="0"
                          max="9"
                          class="form-control mb-3"
                        />
                      </div>
                    </div>
                    <button
                      v-if="showMenteeOtp"
                      type="button"
                      v-on:click="verify"
                      class="btn btn-primary px-5"
                    >
                      {{ $t("login_form_section.verify") }}
                    </button>
                    <div class="timer mb-4" v-if="otpResend">
                      <span class="me-5" v-if="timerCount > 0">
                        {{ timerCount }}</span
                      >
                      <a
                        v-if="!isResendDisabled"
                        href="javascript:void(0)"
                        v-on:click="resendOtp"
                      >
                        {{ $t("login_form_section.resend") }}</a
                      >
                    </div>
                    <div
                      class="form-check mt-2 col-12 d-flex align-items-center"
                      v-if="!showMenteeOtp"
                    >
                      <input
                        type="checkbox"
                        v-model="mentee_condition"
                        class="form-check-input"
                        id="mentor_condition"
                      />
                      <label
                        class="form-check-label ms-2"
                        for="mentor_condition"
                        ><a
                          data-bs-toggle="modal"
                          data-bs-target="#exampleModal"
                          href="javascript:void(0)"
                          >{{ $t("terms_conditions.agree") }}</a
                        ></label
                      >
                    </div>

                    <button
                      v-if="!otpResend"
                      class="btn btn-primary w-100 my-3"
                      v-on:click="sendOTP()"
                    >
                      {{ $t("signup_form_section.label_10") }}
                    </button>
                  </div>
                </div>
                <p v-if="login_type == 'email'" class="text-center mt-4 signin">
                  {{ $t("signup_form_section.label_6") }}

                  <a href="/login" class="text-decoration-none">
                    {{ $t("signup_form_section.label_7") }}
                  </a>
                </p>
                <div class="small text-center" v-else>
                  <p>
                    {{ $t("signup_form_section.label_6") }}
                    <a href="/login" class="text-secondary">
                      {{ $t("signup_form_section.label_7") }}</a
                    >
                  </p>
                </div>
                <hr />
                <p class="text-center">
                  {{ $t("signup_form_section.label_8") }}
                </p>
                <div
                  class="social-signup d-flex justify-content-center align-items-center"
                >
                  <button
                    class="btn btn-fb me-3 text-white mt-1"
                    @click="redirectFB()"
                  >
                    <i class="fa-brands fa-facebook-f me-1"></i>
                    <label for="" class="d-lg-block d-none"> Facebook </label>
                  </button>
                  <button class="btn btn-insta me-3 text-white mt-1">
                    <i class="fa-brands fa-twitter me-1"></i>
                    <label for="" class="d-lg-block d-none"> Twitter </label>
                  </button>
                  <button
                    class="btn btn-g text-white mt-1"
                    @click="redirectGoogle()"
                  >
                    <i class="fa-brands fa-google-plus-g me-1"></i>
                    <label for="" class="d-lg-block d-none"> Google </label>
                  </button>
                </div>
              </div>
              <div
                class="tab-pane fade"
                id="pills-profile"
                role="tabpanel"
                aria-labelledby="pills-profile-tab"
              >
                <input type="hidden" id="mentor_fbId" />
                <div class="form-signup">
                  <div class="login-email" v-if="login_type == 'email'">
                    <div class="row">
                      <div class="col-lg-6">
                        <input
                          type="text"
                          name="mentor_first_name"
                          id="mentor_first_name"
                          placeholder="First Name here"
                          class="form-control mt-4"
                          :class="
                            errors && errors.first_name ? 'border-danger' : ''
                          "
                        />
                        <p
                          v-if="errors && errors.first_name"
                          class="text-danger small"
                        >
                          {{ errors.first_name[0] }}
                        </p>
                      </div>
                      <div class="col-lg-6">
                        <input
                          type="text"
                          name="mentor_last_name"
                          id="mentor_last_name"
                          placeholder="Last Name here"
                          class="form-control mt-4"
                          :class="
                            errors && errors.last_name ? 'border-danger' : ''
                          "
                        />
                        <p
                          v-if="errors && errors.last_name"
                          class="text-danger small"
                        >
                          {{ errors.last_name[0] }}
                        </p>
                      </div>
                    </div>
                    <input
                      type="email"
                      name="mentor_email"
                      id="mentor_email"
                      placeholder="Email address here"
                      class="form-control mt-4"
                      :class="errors && errors.email ? 'border-danger' : ''"
                    />
                    <p v-if="errors && errors.email" class="text-danger small">
                      {{ errors.email[0] }}
                    </p>
                    <div class="position-relative">
                      <input
                        :type="type"
                        name="mentor_password"
                        id="mentor_password"
                        placeholder="Password"
                        class="form-control mt-4"
                        :class="
                          errors && errors.password ? 'border-danger' : ''
                        "
                      />
                      <p
                        v-if="errors && errors.password"
                        class="text-danger small"
                      >
                        {{ errors.password[0] }}
                      </p>
                      <a v-if="icon == 'show'" href="javascript:void(0)">
                        <i
                          class="fa-solid fa-eye position-absolute"
                          id="togglePassword"
                          @click="showPassword"
                        ></i>
                      </a>
                      <a v-if="icon == 'hide'" href="javascript:void(0)">
                        <i
                          class="fa-solid fa-eye-slash position-absolute"
                          id="togglePassword"
                          @click="showPassword"
                        ></i>
                      </a>
                    </div>
                    <div class="position-relative">
                      <input
                        :type="type"
                        name="mentor_confirm_password"
                        id="mentor_confirm_password"
                        placeholder="Repeat Password"
                        class="form-control mt-4"
                        :class="
                          errors && errors.password ? 'border-danger' : ''
                        "
                      />
                      <a v-if="c_icon == 'show'" href="javascript:void(0)">
                        <i
                          class="fa-solid fa-eye position-absolute"
                          id="togglePassword"
                          @click="showConfirmPassword"
                        ></i>
                      </a>
                      <a v-if="c_icon == 'hide'" href="javascript:void(0)">
                        <i
                          class="fa-solid fa-eye-slash position-absolute"
                          id="togglePassword"
                          @click="showConfirmPassword"
                        ></i>
                      </a>
                    </div>
                    <div
                      class="form-check mb-2 mt-3 col-12 d-flex align-items-center"
                    >
                      <input
                        type="checkbox"
                        v-model="mentor_condition"
                        class="form-check-input"
                        id="mentor_condition"
                      />
                      <label
                        class="form-check-label ms-2"
                        for="mentor_condition"
                        ><a
                          data-bs-toggle="modal"
                          data-bs-target="#exampleModal"
                          href="javascript:void(0)"
                          >Agree with our terms & conditions</a
                        ></label
                      >
                    </div>
                    <button
                      class="btn btn-secondary text-white w-100 mt-5"
                      @click="registerMentor()"
                    >
                      Sign Up
                    </button>
                  </div>

                  <div class="login-phone" v-if="login_type == 'phone'">
                    <div class="mt-4 mb-3">
                      <label for="" class="mb-2 text-dark fw-500"
                        >Mobile<span class="text-danger">*</span></label
                      >
                      <input
                        type="tel"
                        v-model="mentor_number"
                        :disabled="disabled"
                        class="form-control mt-2"
                        placeholder=""
                        id="mentor_tel"
                      />

                      <input type="hidden" name="" id="result" />
                    </div>

                    <div class="mt-4" id="recaptcha-container"></div>

                    <div class="opt-section mt-4" v-if="showMentorOtp">
                      <h5 class="underline mb-3">
                        {{ $t("login.mentor.enter_otp") }}
                      </h5>
                      <div class="d-flex otp flex-wrap flex-row">
                        <input
                          v-model="mentor.val1"
                          type="text"
                          maxLength="1"
                          id="1"
                          min="0"
                          max="9"
                          class="form-control mb-3"
                        />
                        <input
                          v-model="mentor.val2"
                          type="text"
                          maxLength="1"
                          id="2"
                          min="0"
                          max="9"
                          class="form-control mb-3"
                        />
                        <input
                          v-model="mentor.val3"
                          type="text"
                          id="3"
                          maxLength="1"
                          min="0"
                          max="9"
                          class="form-control mb-3"
                        />
                        <input
                          v-model="mentor.val4"
                          type="text"
                          maxLength="1"
                          id="4"
                          min="0"
                          max="9"
                          class="form-control mb-3"
                        />
                        <input
                          v-model="mentor.val5"
                          type="text"
                          maxLength="1"
                          id="5"
                          min="0"
                          max="9"
                          class="form-control mb-3"
                        />
                        <input
                          v-model="mentor.val6"
                          type="text"
                          maxLength="1"
                          id="6"
                          min="0"
                          max="9"
                          class="form-control mb-3"
                        />
                      </div>
                    </div>

                    <div class="timer mb-4" v-if="otpResend">
                      <span class="me-5" v-if="timerCount > 0">
                        {{ timerCount }}</span
                      >
                      <a
                        v-if="!isResendDisabled"
                        href="javascript:void(0)"
                        v-on:click="resendOtp"
                      >
                        {{ $t("login_form_section.resend") }}</a
                      >
                    </div>

                    <div
                      class="form-check mt-2 col-12 d-flex align-items-center"
                      v-if="!showMentorOtp"
                    >
                      <input
                        type="checkbox"
                        v-model="mentor_condition"
                        class="form-check-input"
                        id="mentor_condition"
                      />
                      <label
                        class="form-check-label ms-2"
                        for="mentor_condition"
                        ><a
                          data-bs-toggle="modal"
                          data-bs-target="#exampleModal"
                          href="javascript:void(0)"
                          >{{ $t("terms_conditions.agree") }}</a
                        ></label
                      >
                    </div>

                    <button
                      v-if="showMentorOtp"
                      v-on:click="verify"
                      class="btn btn-primary px-5"
                    >
                      {{ $t("login_form_section.verify") }}
                    </button>

                    <button
                      v-if="!otpResend"
                      class="btn btn-primary w-100 my-4"
                      @click="sendOTP()"
                    >
                      {{ $t("signup_form_section.label_10") }}
                    </button>
                  </div>
                </div>
                <p v-if="login_type == 'email'" class="text-center mt-4 signin">
                  Already have an account?
                  <a href="/login" class="text-decoration-none">Sign In</a>
                </p>
                <div class="small text-center" v-else>
                  <p>
                    {{ $t("signup_form_section.label_6") }}
                    <a href="/login" class="text-secondary">
                      {{ $t("signup_form_section.label_7") }}</a
                    >
                  </p>
                </div>
                <hr />
                <p class="text-center">Or Sign up with social media</p>
                <div
                  class="social-signup d-flex justify-content-center align-items-center"
                >
                  <button
                    class="btn btn-fb me-3 text-white mt-1"
                    @click="redirectFB()"
                  >
                    <i class="fa-brands fa-facebook-f me-1"></i>
                    <label for="" class="d-lg-block d-none"> Facebook </label>
                  </button>
                  <button class="btn btn-insta me-3 text-white mt-1">
                    <i class="fa-brands fa-twitter me-1"></i>
                    <label for="" class="d-lg-block d-none"> Twitter </label>
                  </button>
                  <button
                    class="btn btn-g text-white mt-1"
                    @click="redirectGoogle()"
                  >
                    <i class="fa-brands fa-google-plus-g me-1"></i>
                    <label for="" class="d-lg-block d-none"> Google </label>
                  </button>
                </div>
              </div>
              <div
                class="tab-pane fade"
                id="pills-contact"
                role="tabpanel"
                aria-labelledby="pills-contact-tab"
              >
                ...
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-12 px-0">
          <img
            :src="url + '/assets/images/sign-up-side-img.png'"
            alt=""
            class="img-fluid signup-wrapper w-100 d-md-block d-none position-sticky top-0"
          />
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content border-0">
          <div class="modal-header text-white bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">
              Terms & Conditions
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div v-html="terms_and_conditions"></div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from "axios";
import loginMixin from "../mixins/loginMixin.js";

export default {
  props: ["url", "fbemail", "fbid", "logo", "login_type"],
 mixins: [loginMixin],
  data() {
    return {
      is_mentor: false,
      type: "password",
      mentor_condition: "",
      mentee_condition: "",
      icon: "show",
      c_icon: "show",
      terms_and_conditions: "no content",
      errors: {},
      mentee_errors: {},
      timerCount: 60,
      mentor_number: "",
      mentee_number: "",
      appVerifier: "",
      otp: "",
      mentor: {
        val1: "",
        val2: "",
        val3: "",
        val4: "",
        val5: "",
        val6: "",
      },
      mentee: {
        val1: "",
        val2: "",
        val3: "",
        val4: "",
        val5: "",
        val6: "",
      },
      is_mentor: false,
      otpResend: false,
      disabled: false,
      showMenteeOtp: false,
      showMentorOtp: false,
      mentor_capcha_render: false,
      isResendDisabled:true,
    };
  },
  methods: {
    showPassword() {
      if (this.type === "password") {
        this.type = "text";
        this.icon = "hide";
      } else {
        this.type = "password";
        this.icon = "show";
      }
    },
    showConfirmPassword() {
      if (this.type === "password") {
        this.type = "text";
        this.c_icon = "hide";
      } else {
        this.type = "password";
        this.c_icon = "show";
      }
    },
    redirectFB() {
      if (this.is_mentor) {
        localStorage.setItem("role", "Mentor");
      } else {
        localStorage.setItem("role", "Mentee");
      }
      window.location.href = "/auth/facebook";
    },
    redirectGoogle() {
      if (this.is_mentor) {
        localStorage.setItem("role", "Mentor");
      } else {
        localStorage.setItem("role", "Mentee");
      }
      window.location.href = "auth/google";
    },
    changeRole(role) {
      if (role == "Mentor") {
        this.disabled = false;
        this.is_mentor = true;
        this.otpResend = false;
        this.showMentorOtp = false;
        this.showMenteeOtp = false;
        this.timerCount = 60;
        if (!this.mentor_capcha_render && this.login_type == "phone") {
          this.recapchaForMentor();
        }
        this.mentor_capcha_render = true;
      } else if (role == "Mentee") {
        this.disabled = false;
        this.is_mentor = false;
        this.showMentorOtp = false;
        this.otpResend = false;
        this.showMenteeOtp = false;
        this.timerCount = 60;
      }
    },

    registerMentor() {
      var toast = this.$toasted;

      if (this.mentor_condition == "") {
        toast.error("Please select Terms & Conditions");
        return false;
      }
      let email = document.getElementById("mentor_email").value;
      let password = document.getElementById("mentor_password").value;
      let confirm_password = document.getElementById(
        "mentor_confirm_password"
      ).value;
      let mentor_last_name = document.getElementById("mentor_last_name").value;
      let mentor_first_name =
        document.getElementById("mentor_first_name").value;

      let mentor_fbId = document.getElementById("mentor_fbId").value;
      const params = {
        role: "Mentor",
        email: email,
        password: password,
        password_confirmation: confirm_password,
        fb_id: mentor_fbId,
        first_name: mentor_first_name,
        last_name: mentor_last_name,
      };
      axios
        .post("/api/signup-email", params)
        .then((response) => {
          if (response.data.Status) {
            let user_id = response.data.data.user.id;
            // toast.success(response.data.msg);
            var User = {
              role: "Mentor",
              user_id: user_id,
              _token: 123,
              AccessToken: response.data.AccessToken,
            };
            localStorage.setItem("User", JSON.stringify(User));
            toast.success(response.data.msg);
            window.location.href = "/mentor-profile";
          }
          if (!response.data.Status && response.data.errors) {
            this.errors = response.data.errors;
          }
          // for (const property in response.data.errors) {
          //     toast.error(response.data.errors[property][0]);
          // }
        })
        .catch((error) => {
          toast.error(error);
        });
    },
    registerMentee() {
      var toast = this.$toasted;
      if (this.mentee_condition == "") {
        toast.error("Please select Terms & Conditions");
        return false;
      }
      let email = document.getElementById("mentee_email").value;
      let password = document.getElementById("mentee_password").value;
      let confirm_password = document.getElementById(
        "mentee_confirm_password"
      ).value;
      let mentee_last_name = document.getElementById("mentee_last_name").value;
      let mentee_first_name =
        document.getElementById("mentee_first_name").value;
      let mentee_fbId = document.getElementById("mentee_fbId").value;
      const params = {
        role: "Mentee",
        email: email,
        password: password,
        password_confirmation: confirm_password,
        fb_id: mentee_fbId,
        first_name: mentee_first_name,
        last_name: mentee_last_name,
      };
      axios
        .post("/api/signup-email", params)
        .then((response) => {
          if (response.data.Status) {
            let user_id = response.data.data.user.id;
            // toast.success(response.data.msg);
            var User = {
              role: "Mentee",
              user_id: user_id,
              _token: 123,
              AccessToken: response.data.AccessToken,
            };
            localStorage.setItem("User", JSON.stringify(User));
            localStorage.setItem(
              "menteeProfileCompleted",
              JSON.stringify(
                response.data.data.user.mentee.is_profile_completed
              )
            );
            toast.success(response.data.msg);
            if (document.referrer) window.location.href = document.referrer;
            else window.location.href = "/";
          }
          if (!response.data.Status && response.data.errors) {
            this.mentee_errors = response.data.errors;
          }
          // for (const property in response.data.errors) {
          //     toast.error(response.data.errors[property][0]);
          // }
        })
        .catch((error) => {
          toast.error(error);
        });
    },
    sendOTP() {
      var self = this;
      var toast = this.$toasted;
      if (this.is_mentor == true) {
        if (this.mentor_condition == "") {
          toast.error("Please select Terms & Conditions");
          return false;
        }
        var Entered_number = this.mentor_number;
        var input = document.getElementsByClassName(
          "iti__selected-dial-code"
        )[0];
        var country_code = input.innerHTML;
        var number = country_code + Entered_number;
      }
      if (this.is_mentor == false) {
        if (this.mentee_condition == "") {
          toast.error("Please select Terms & Conditions");
          return false;
        }
        var Entered_number = this.mentee_number;
        var input = document.getElementsByClassName(
          "iti__selected-dial-code"
        )[1];
        var country_code = input.innerHTML;
        var number = country_code + Entered_number;
      }
      console.log("send otp");
      firebase
        .auth()
        .signInWithPhoneNumber(number, window.recaptchaVerifier)
        .then(function (confirmationResult) {
          window.confirmationResult = confirmationResult;
          toast.success("OTP is Sent");
          self.disabled = true;
          if (self.is_mentor == true) {
            self.showMentorOtp = true;
            self.showMenteeOtp = false;
          } else {
            self.showMenteeOtp = true;
            self.showMentorOtp = false;
          }
          self.timerCount = 60;
          self.otpResend = true;
        })
        .catch(function (error) {
          toast.error(error.message);
        });
    },
    verify() {
      var toast = this.$toasted;
      var self = this;
      if (this.is_mentor == true) {
        if (this.mentor_condition == "") {
          toast.success("Please select Terms & Conditions");
          return false;
        }
        var code =
          this.mentor.val1 +
          this.mentor.val2 +
          this.mentor.val3 +
          this.mentor.val4 +
          this.mentor.val5 +
          this.mentor.val6;
        var Entered_number = this.mentor_number;
        var input = document.getElementsByClassName(
          "iti__selected-dial-code"
        )[0];
        var country_code = input.innerHTML;
        var number = country_code + Entered_number;
      }
      if (this.is_mentor == false) {
        if (this.mentee_condition == "") {
          toast.success("Please select Terms & Conditions");
          return false;
        }
        var code =
          this.mentee.val1 +
          this.mentee.val2 +
          this.mentee.val3 +
          this.mentee.val4 +
          this.mentee.val5 +
          this.mentee.val6;
      }
      window.confirmationResult
        .confirm(code)
        .then(function (result) {
          var user = result.user;
          toast.success("OTP is Verified");
          self.doLogin();
        })
        .catch(function (error) {
          toast.error("Verification Code is Invalid");
        });
    },
    doLogin() {
      var number;
      var toast = this.$toasted;
      var self = this;
      if (this.is_mentor == true) {
        var Entered_number = this.mentor_number;
        var input = document.getElementsByClassName(
          "iti__selected-dial-code"
        )[0];
        var country_code = input.innerHTML;
        number = country_code + Entered_number;
        this.role = "Mentor";
      }
      if (this.is_mentor == false) {
        this.role = "Mentee";
        var Entered_number = this.mentee_number;
        var input = document.getElementsByClassName(
          "iti__selected-dial-code"
        )[1];
        var country_code = input.innerHTML;
        number = country_code + Entered_number;
      }
      const params = {
        role: this.role,
        token: 123,
        phone: number.replace("+", ""),
        is_login_page: false,
      };
      axios
        .post("/api/login-signup", params)
        .then((response) => {
          if (response.data && response.data.Status == true) {
            var User = {
              role: response.data.data.role,
              user_id: response.data.data.userDetail[0].id,
              _token: 123,
            };
            localStorage.setItem("User", JSON.stringify(User));
            localStorage.setItem(
              "menteeProfileCompleted",
              JSON.stringify(response.data.data.is_profile_completed)
            );

            toast.success(response.data.msg);
            if (this.role == "Mentee" && document.referrer) {
              window.location.href = document.referrer;
              return;
            }
            if (
              this.role == "Mentor" &&
              response.data.data.is_profile_complete == 0
            ) {
              window.location.href = "/mentor-profile";
            } else if (
              this.role == "Mentor" &&
              response.data.data.is_profile_complete == 1 &&
              response.data.data.first_time
            ) {
              window.location.href = "/dashboard";
            } else if (
              this.role == "Mentor" &&
              response.data.data.is_profile_complete == 1
            ) {
              window.location.href = "/";
            } else {
              window.location.href = "/";
            }
          } else {
            toast.error(response.data.msg);
            window.location.href = "/login";
          }
        })
        .catch((error) => {
          toast.error("User Not Found");
        });
    },
    resendOtp() {
      if (this.is_mentor == true) {
        this.$toasted.error("Please Verify Recapcha");
        this.sendOTP();
      }
      if (this.is_mentor == false) {
        this.$toasted.error("Please Verify Recapcha");
        this.sendOTP();
      }
    },
    recapchaForMentor() {
      window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
        "recaptcha-container"
      );
      recaptchaVerifier.render();
    },
    render() {
      window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
        "recaptcha-container-mentee"
      );
      recaptchaVerifier.render();
    },
    async fetchTermsAndConditions() {
      const res = await axios.get("/api/terms_conditions", {
        params: { token: 123 },
      });
      if (res.data.data.value ?? false) {
        this.terms_and_conditions = res.data.data.value;
      }
    },
  },
  created() {
    this.checkLoggedIn();
    if (this.is_loggedIn) {
      window.location.href = this.url;
    }
    this.fetchTermsAndConditions();
  },
  mounted() {
    if (this.login_type == "phone") {
      this.render();
    }
    var toast = this.$toasted;
    if (this.user_id) {
      let role = localStorage.getItem("role");
      let user;
      if (role == "Mentor") {
        user = {
          role: "Mentor",
          user_id: this.user_id,
          _token: 123,
          AccessToken: this.access_token,
        };
        localStorage.setItem("User", JSON.stringify(user));

        toast.success("Successfully Login");
        localStorage.removeItem("role");
        window.location.href = "/";
      } else if (role == "Mentee") {
        user = {
          role: "Mentee",
          user_id: this.user_id,
          _token: 123,
          AccessToken: this.access_token,
        };
        localStorage.setItem("User", JSON.stringify(user));

        toast.success("Successfully Login");
        localStorage.removeItem("role");
        window.location.href = "/";
      }
    }
  },
  watch: {
  timerCount: {
    handler(value) {
      if (value > 0) {
        setTimeout(() => {
          this.isResendDisabled = true;
          this.timerCount--;
        }, 1500);
      }else{
        this.isResendDisabled = false;
      }
    },
    immediate: true, // This ensures the watcher is triggered upon creation
  },
  mentee: {
    handler(val) {
      // do stuff
      $("input").keyup(function () {
        if ($(this).val().length == $(this).attr("maxlength")) {
          var i = $("input").index(this);
          $("input")
            .eq(i + 1)
            .focus();
        }
      });
    },
    deep: true,
    immediate: true,
  },
  mentor: {
    handler(val) {
      // do stuff
      $("input").keyup(function () {
        if ($(this).val().length == $(this).attr("maxlength")) {
          var i = $("input").index(this);
          $("input")
            .eq(i + 1)
            .focus();
        }
      });
    },
    deep: true,
    immediate: true,
  },
},
};
</script>
