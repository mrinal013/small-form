// collect all elements with smallformid data
let elements = document.querySelectorAll("[data-smallformid]");
// loop through each element
elements.forEach(function(element) {
  // 1. get metas from specific form post.
  // 2. crete vue instance for every element.
  // 3. make ajax call if email is valid.
  // 4. make ajax call with email, description and form id.
  let formId = element.getAttribute("data-smallformid");
  axios.get("/wp-json/wp/v2/small-form/" + formId).then(response => {
    let small_form_meta = response.data._small_form_meta;
    new Vue({
      el: element,
      data: function() {
        return {
          emailEntry: null,
          descEntry: null
        };
      },
      created: function() {
        this.emailLabel = small_form_meta.email_label;
        this.descLabel = small_form_meta.desc_label;
        this.submitText = small_form_meta.submit_text;
      },
      methods: {
        submitForm: function() {
          let hasError = document.querySelector(".error-message");
          if (hasError) {
            let element = document.querySelector(".error-message");
            element.parentNode.removeChild(element);
          }
          if (this.emailEntry) {
            let emailValidation = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(
              this.emailEntry
            )
              ? true
              : false;
            if (emailValidation) {
              document
                .querySelector(".small-form button")
                .insertAdjacentHTML(
                  "afterend",
                  "<span class='spinner'>Working...</span>"
                );
              let queryString =
                "?action=small_form_submit&nonce=" +
                ajax_object.nonce +
                "&formid=" +
                formId +
                "&email=" +
                this.emailEntry +
                "&desc=" +
                this.descEntry;
              axios
                .get(ajax_object.ajax_url + queryString)
                .then(response => {
                  let element = document.querySelector(".spinner");
                  setTimeout(() => {
                    element.parentNode.removeChild(element);
                    let formElement = document.querySelector(".small-form");
                    formElement.innerHTML = "";
                    document
                      .querySelector(".small-form")
                      .insertAdjacentHTML(
                        "afterbegin",
                        "<div class='success-message'>Thank you.</div>"
                      );
                  }, 1000);
                })
                .catch(error => {
                  document
                    .querySelector(".small-form button")
                    .insertAdjacentHTML(
                      "beforebegin",
                      "<div class='error-message'>Can not be saved. Please try again.</div>"
                    );
                });
            } else {
              document
                .querySelector(".small-form input")
                .insertAdjacentHTML(
                  "afterend",
                  "<div class='error-message'>Invalid email address</div>"
                );
            }
          } else {
            document
              .querySelector(".small-form input")
              .insertAdjacentHTML(
                "afterend",
                "<div class='error-message'>This field is required</div>"
              );
          }
        }
      },
      template:
        '<div class="small-form">\
          <label><span>{{emailLabel}}</span><span class="required">*</span><br>\
            <input type="text" v-model="emailEntry">\
          </label><br/>\
          <label><span>{{descLabel}}</span><br>\
            <textarea v-model="descEntry"></textarea>\
          </label><br>\
          <button @click="submitForm">{{submitText}}</button>\
        </div>'
    });
  });
});
