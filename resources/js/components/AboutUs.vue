<template>
    <div>
        <header class="about-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div
                            class="d-flex justify-content-center align-items-center flex-column"
                        >
                            <h2 class="text-white text-center head fw-bold">
                                  {{$t('about_banner_section.heading')}}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="about-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-5 d-flex justify-content-center flex-column">
                        <h2 class="head text-primary fw-bold">
                             {{content.section_1_title}}

                        </h2>

                        <p class="sub-head mt-3">
                            {{content.section_1_description}}
                        </p>
                    </div>
                    <div class="col-xl-6 col-md-7 rtl-img">
                        <div
                            class="square-border-img d-flex flex-column justify-content-center h-100 mt-md-0 mt-4"
                        >
                            <div class="border">
                              <img :src="content.section_1_image" alt="" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-secondary text-white why-choose-us">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="head text-center fw-bold">
                             {{content.section_2_title}}

                        </h2>
                        <p class="text-center mt-3 mb-5">
                          {{content.section_2_description}}
                        </p>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-xxl-3 col-lg-4 col-md-6">
                        <div
                            class="card border-0 bg-transparent d-flex justify-content-center align-items-center mt-5"
                        >
                            <img
                                :src="content.section_2_first_image"
                                alt=""
                                class="img-fluid"
                            />
                            <h3 class="fw-bold mt-3 text-center">
                                                           {{content.section_2_first_heading}}
                            </h3>
                            <span class="text-center">
                                 {{content.section_2_first_sub_heading}}

                            </span>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-md-6">
                        <div
                            class="card border-0 bg-transparent d-flex justify-content-center align-items-center mt-5"
                        >
                            <img
                                :src="content.section_2_second_image"
                                alt=""
                                class="img-fluid"
                            />
                            <h3 class="fw-bold mt-3 text-center">
                                 {{content.section_2_second_heading}}
                            </h3>
                            <span class="text-center">
                                {{content.section_2_second_sub_heading}}
                            </span>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-md-6">
                        <div
                            class="card border-0 bg-transparent d-flex justify-content-center align-items-center mt-5"
                        >
                            <img
                                :src="content.section_2_third_image"
                                alt=""
                                class="img-fluid"
                            />
                            <h3 class="fw-bold mt-3 text-center">
                               {{content.section_2_third_heading}}

                            </h3>
                            <span class="text-center">
                                    {{content.section_2_third_sub_heading}}

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white our-mission">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div
                            class="d-flex justify-content-center align-items-center h-100"
                        >
                            <img :src="content.section_3_image" alt="" class="img-fluid" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="head text-primary fw-bold mt-lg-0 mt-5">
                            {{content.section_3_title}}
                        </h2>

                        <p class="sub-head mt-3">
                           {{content.section_3_description}}
                        </p>
                    </div>
                </div>
            </div>
        </section>

    </div>
</template>

<script>
export default {
    props: ["url"],
    data() {
        return {
            content: "",
            loading: true,
        }

    },
    created() {
        this.fetchAboutUsPageContent();
    },
    methods: {
        async fetchAboutUsPageContent() {
            this.loading = true;
            const params = {
                token: 123,
            };
            const res = await axios.get("/api/get_about_us_page_content", {
                params
            });

            if (res.data && res.data.Status) {
                this.content = res.data.data.about_us_content
                this.loading = false;
            }
        },
    }
};
</script>
