 <template>
  <div class="mt-5">
    <div class="main chat p-md-5">
      <div class="">
        <div class="row clearfix">
          <div class="col-lg-12">
            <div class="card chat-app border-0">
              <div class="chat">
                <div class="chat-history border" v-chat-scroll>
                  <ul class="m-b-0" type="none">
                    <div v-for="message in messages" :key="message.id">
                      <li
                        v-if="sender_id === message.sender_id"
                        class="clearfix"
                      >
                        <div class="message-data text-end"></div>
                        <div class="d-flex flex-row justify-content-end my-4">
                          <div class="message my-message float-right">
                            {{ message.message }}<br>
                              <span v-if="message.is_attachment">
                                <img :src="message.attachment_url" height="100px" alt="">
                            </span>
                          </div>
                          <a
                            href="javascript:void(0);"
                            data-toggle="modal"
                            data-target="#view_info"
                            class="d-flex justify-content-center"
                          >
                            <img
                              src="https://bootdey.com/img/Content/avatar/avatar2.png"
                              alt="avatar"
                              class="chat-profile"
                              height="50px"
                            />
                          </a>
                        </div>
                      </li>
                      <li v-else class="clearfix">
                        <div class="message-data"></div>
                        <div class="d-flex my-4">
                          <a
                            href="javascript:void(0);"
                            data-toggle="modal"
                            data-target="#view_info"
                            class="d-flex justify-content-center"
                          >
                            <img
                              src="https://bootdey.com/img/Content/avatar/avatar2.png"
                              alt="avatar"
                              class="chat-profile"
                              height="50px"
                            />
                          </a>
                          <div class="message other-message">
                            {{ message.message }}<br>
                               <span v-if="message.is_attachment">
                                <img :src="message.attachment_url" height="100px" alt="">
                            </span>
                          </div>
                        </div>
                      </li>
                    </div>
                  </ul>
                </div>
                <div class="chat-message clearfix bg-light d-flex px-3">
                  <div class="input-group">
                    <input
                      :placeholder="$t('mentee_chat.placeholder_1')"
                      type="text"
                      class="form-control"
                      aria-label="Amount (to the nearest dollar)"
                      @keyup.enter="sendMessage"
                      v-model="newMessage"
                    />
                    <div class="upload-btn-wrapper align-items-center">
                        <span v-if="attachment_file.name">{{attachment_file.name}}</span>
                        <img v-if="attachment_file_url" :src="attachment_file_url" width="50" height="50" alt="">
                        <button class="btn px-2">
                            <i class="fa-solid fa-paperclip"></i>
                            <input type="file" id="attachment" ref="attachment"
                            @change="processAttachmentFile($event)" name="" />
                        </button>
                    </div>
                    <button
                      type="button"
                      v-on:click="sendMessage"
                      class="btn btn-transparent text-secondary"
                    >
                      <i class="fas fa-paper-plane"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import loginMixin from "../mixins/loginMixin.js";
export default {
  props: ["url", "id", "pusher_channel_name", "pusher_event_name"],
  mixins: [loginMixin],
  data() {
    return {
      messages: [],
      newMessage: "",
      users: [],
      activeUser: false,
      typingTimer: false,
      sender_id: "",
      receiver_id: "",
      appointment: {},
      attachment_file: "",
      attachment_file_url: "",
    };
  },
  created() {
    this.checkLoggedIn();
    this.appointmentDetails();

    window.Echo.channel(this.pusher_channel_name).listen(this.pusher_event_name, (e) => {
      if (e.message.receiver_id == this.sender_id && e.message.appointment_id == this.appointment.id) {
        this.messages.push({
          message: e.message.message,
          receiver_id: e.message.receiver_id,
          attachment_url: e.message.attachment_url,
          is_attachment: e.message.is_attachment,
        });
      }
    });
  },

  methods: {
    async appointmentDetails() {
      const params = {
        token: 123,
        appointment_id: this.id,
        user_id: this.User.user_id,
      };
      const res = await axios.get("/api/appointmentDetails", { params });
      if (res.data && res.data.Status) {
        this.appointment = res.data.data.appointment;
        // this.loading = false;
        if (this.User.role == "Mentor") {
          this.sender_id = this.User.user_id;
          this.receiver_id = res.data.data.appointment.mentee_id;
        }
        if (this.User.role == "Mentee") {
          this.sender_id = this.User.user_id;
          this.receiver_id = res.data.data.appointment.mentor_id;
        }
        this.fetchMessages();
      }
    },
    async sendMessage() {
      if (!this.newMessage && !this.attachment_file) {
        this.$toasted.error("Please Select attachment or type message");
        return;
      }
      const headers = {
        "Content-Type": "multipart/form-data",
      };

      var self = this;
      var message = this.newMessage;
      this.newMessage = "";
      let formData = new FormData();
      formData.append("token", 123);
      formData.append("sender_id", this.sender_id);
      formData.append("receiver_id", this.receiver_id);
      formData.append("message", message);
      formData.append("attachment", this.attachment_file);
      formData.append("appointment_id", this.appointment.id);
      const res = await axios
       .post("/api/send-message", formData, {
                    headers: headers,
                })
        .then((res) => {
          if (res.data.Status) {
            this.messages.push({
              message: message,
              sender_id: this.sender_id,
              attachment_url: res.data.data.message.attachment_url,
              is_attachment: res.data.data.message.is_attachment,
            });

            this.$refs.attachment.value = null;
            this.attachment_file = "";
            this.attachment_file_url = "";
            this.sendNewMessageNotification(message);
          }
        });
    },
    async sendNewMessageNotification(message) {
      const params = {
        token: 123,
        user_id: this.receiver_id,
        body: message,
        title: "New Message",
        link: "",
      };
      const res = await axios
        .post("/api/send-web-notification", params)
        .then((res) => {});
    },
    async fetchMessages() {
      const params = {
        token: 123,
        receiver_id: this.receiver_id,
        sender_id: this.sender_id,
        appointment_id: this.appointment.id
      };
      const res = await axios.get("/api/fetch-messages", { params });
      if (res.data && res.data.Status) {
        this.messages = res.data.data.messages;
      }
    },
    processAttachmentFile(event) {
      this.attachment_file = event.target.files[0];
      this.attachment_file_url = URL.createObjectURL(event.target.files[0]);
      console.log(URL.createObjectURL(event.target.files[0]));
    },
  },
};
</script>

<style scoped>
/* .chat-profile{
height: 70px;
width: 70px;
border-radius: 50%;
}
.chat-app{
    position: fixed;
    width: 400px;
    bottom: 0;
    right: 12px;
    z-index: 99999;

} */
.chat-history {
  height: 350px;
  overflow-y: auto;
}
@media only screen and (max-width: 767px) {
  .chat-history {
    height: 300px;
    overflow-y: auto;
  }
}
</style>
