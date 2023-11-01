<template>
    <div>

        <section class="blog-detail">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 p-md-0" v-if="loading">
                         <img src="/assets/images/logo.png" height="20px" alt="">
                    </div>
                    <div class="col-md-12 p-md-0" v-else>
                        <h2 class="text-dark fw-bold text-center mb-5 text-capitalize">
                            {{page.name}}
                        </h2>

                        <div class="card border-0 p-md-5 p-3 shadow mb-2 rounded-0">
                            <p v-html="page.description">
                                </p>

                            <p class="text-greish mt-1 mb-0">
                                    <i
                                    class="fa-solid fa-calendar-days text-primary pe-3"
                                ></i>
                               {{new Date(page.created_at).toLocaleDateString('en-us', { weekday:"long", year:"numeric", month:"short", day:"numeric"})}}
                                </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    props: ["url","slug"],
    data(){
      return{
          page: {},
          loading: true,
      }
   },
   methods :{
       async getContentPage()
       {
            const params = {
                token: 123,
                slug:this.slug,
            };
            const res = await axios.get("/api/page-with-slug", { params });
            if (res.data && res.data.Status) {
                this.page = res.data.data.page;
                this.loading = false
            }
       },

   },
   created()
   {
       this.getContentPage();
   }
};
</script>
