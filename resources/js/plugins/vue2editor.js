import Vue from "vue";
import Vue2Editor from "vue2-editor";
Vue.mixin({
    methods: {
        $handleImageAdded(file, Editor, cursorLocation, resetUploader) {
            var formData = new FormData();
            formData.append("image", file);

            axios({
                url: this.route('editor.upload_image'),
                method: "POST",
                data: formData
            })
                .then(result => {
                    let url = result.data.url; // Get url from response
                    Editor.insertEmbed(cursorLocation, "image", url);
                    resetUploader();
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
});

Vue.use(Vue2Editor);
