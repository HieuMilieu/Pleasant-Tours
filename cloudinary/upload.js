function uploadURLCloudinary(file, callback) {
    var url = 'https://api.cloudinary.com/v1_1/dbz9ifehj/upload';
    var xhr = new XMLHttpRequest();
    var fd = new FormData();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function(e) {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            var url = response.secure_url;
            callback(url)
        }
    };
    fd.append('upload_preset', 'i1gt3a1r');
    fd.append('tags', 'browser_upload');
    fd.append('file', file);
    xhr.send(fd);
}