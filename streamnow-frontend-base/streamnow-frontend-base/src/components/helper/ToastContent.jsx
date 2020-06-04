import React from "react";
import { withToastManager } from "react-toast-notifications";
const ToastContent = (toastManager, error_message, type) => {
  console.log("Toast called");
  return toastManager.add(error_message, {
    appearance: type,
    autoDismiss: true,
    pauseOnHover: false,
  });
};

export default ToastContent;
