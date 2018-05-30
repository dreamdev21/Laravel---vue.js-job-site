// takes a {} object and returns a FormData object
export const objectToFormData = (obj, form, namespace) => {
  var fd = form || new FormData();
  var formKey;

  for (var property in obj) {
    if (obj.hasOwnProperty(property)) {
      if (namespace) {
        formKey = namespace + "[" + property + "]";
      } else {
        formKey = property;
      }

      // if the property is an object, but not a File,
      // use recursivity.
      if (
        typeof obj[property] === "object" &&
        !(obj[property] instanceof File)
      ) {
        objectToFormData(obj[property], fd, property);
      } else {
        // if it's a string or a File object
        fd.append(formKey, obj[property]);
      }
    }
  }

  return fd;
};

export const ALLOWED_EXTENSIONS = [
  "ipa",
  "apk",
  "xap",
  "appx",
  "zip",
  "rar",
  "7zip",
  "xlsx",
  "xls",
  "odt",
  "exe",
  "doc",
  "docx",
  "pdf",
  "jpg",
  "png",
  "jpeg",
  "bmp"
];
