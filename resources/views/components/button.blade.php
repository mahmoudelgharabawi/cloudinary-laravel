<script type="text/javascript">

    var cloudName = @json(Str::after(config('cloudinary.cloud_url'),'@'));
    var uploadPreset = @json(config('cloudinary.upload_preset'));
    function setCookie(cname, cvalue, exdays) {
      const d = new Date();
      d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
     let expires = "expires="+d.toUTCString();
     document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    function openWidget() {
        window.cloudinary.openUploadWidget(
            { cloud_name: cloudName,
              upload_preset: uploadPreset
            },
            (error, result) => {
              if (!error && result && result.event === "success") {
                console.log('Done uploading..');
                localStorage.setItem("cloud_image_url", result.info.url);
                setCookie("imageUrl",result.info.url,1)
              }
        }).open();
    }
</script>

<button type="button" onclick="openWidget()">
  {{ $slot }}
</button>

