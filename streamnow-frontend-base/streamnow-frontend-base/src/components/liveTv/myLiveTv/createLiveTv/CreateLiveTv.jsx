import React, { Component } from "react";
import { Progress } from "reactstrap";
import api from "../../../../Environment";
import { withToastManager } from "react-toast-notifications";
import Sidebar from "../../../layouts/sidebar/Sidebar";
import Helper from "../../../helper/Helper";
import ToastContent from "../../../helper/ToastContent";

class CreateLiveTv extends Helper {
  state = {
    loaded: 0,
    inputData: {},
    loadingContent: null,
    buttonDisable: false,
    imagePreviewUrl: null,
  };

  saveVideo = (event) => {
    this.setState({
      loadingContent: "Loading...",
      buttonDisable: true,
    });
    event.preventDefault();
    api
      .postMethod("livetv_owner_save", this.state.inputData)
      .then((response) => {
        if (response.data.success) {
          ToastContent(
            this.props.toastManager,
            response.data.message,
            "success"
          );
          this.setState({ loadingContent: null, buttonDisable: false });
        } else {
          ToastContent(this.props.toastManager, response.data.error, "error");
          this.setState({ loadingContent: null, buttonDisable: false });
        }
      })
      .catch((err) => {
        // then print response status
        console.log("Error", err);
      });
  };

  render() {
    const {
      inputData,
      loadingContent,
      buttonDisable,
      imagePreviewUrl,
    } = this.state;
    return (
      <div className="main">
        <Sidebar />
        <div className="sec-padding upload-img-vido left-spacing1">
          <div className="Spacer-10"></div>

          <div className="row small-padding">
            <h2 className="">Upload Your video</h2>

            <div className="Spacer-9"></div>

            <div className="col-md-12 p-0">
              <form className="upload-form box-shadow-1">
                <div className="form-group">
                  <label className="control-label">Title</label>
                  <input
                    className="form-control"
                    placeholder="Enter title"
                    name="title"
                    value={inputData.title}
                    onChange={this.handleChange}
                  />
                </div>
                <div className="form-group">
                  <label className="control-label">Hls URL</label>
                  <input
                    className="form-control"
                    placeholder="HLS URL"
                    name="hls_video_url"
                    value={inputData.hls_video_url}
                    onChange={this.handleChange}
                  />
                </div>
                <div className="form-group">
                  <label className="control-label">RTMP URL</label>
                  <input
                    className="form-control"
                    placeholder="RTMP URL "
                    name="rtmp_video_url"
                    value={inputData.rtmp_video_url}
                    onChange={this.handleChange}
                  />
                </div>

                <div className="form-group">
                  <label className="control-label">Description</label>

                  <textarea
                    className="form-control"
                    placeholder="Enter your description here"
                    name="description"
                    value={inputData.description}
                    onChange={this.handleChange}
                  ></textarea>
                </div>

                <div className="row">
                  <div className="col-md-6">
                    <p className="pt-85">
                      <b>Choose Your Image</b>(Please enter .png .jpeg .jpg
                      images only. Upload Rectangle images 4:3 Ratio Ex: 400 *
                      300)
                    </p>
                    <div className="upload-file-info pt-86">
                      <input
                        type="file"
                        id="file"
                        name="image"
                        accept="image/*"
                        onChange={this.handleChangeImage}
                      />
                      <label htmlFor="file" className="btn-2 btn-2-inverse">
                        Upload Image
                      </label>
                    </div>
                  </div>
                  <div className="col-md-6">
                    <div
                      className="user-profile1"
                      style={{
                        backgroundImage: `url(${
                          imagePreviewUrl != null
                            ? imagePreviewUrl
                            : window.location.origin +
                              "/assets/img/bg-image.jpg"
                        })`,
                      }}
                    ></div>
                  </div>
                  <Progress max="100" color="success" value={this.state.loaded}>
                    {Math.round(this.state.loaded, 2)}%
                  </Progress>
                </div>

                <div className="row">
                  <div className="col-md-6">
                    <button
                      className="btn btn-block"
                      type="submit"
                      onClick={this.saveVideo}
                      disabled={buttonDisable}
                    >
                      {loadingContent != null ? loadingContent : "Upload Now"}
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default withToastManager(CreateLiveTv);
