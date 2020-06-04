import React, { Component } from "react";
import Notification from "./Notification";
import SignInChoose from "../../auth/SignInChoose";
import SignupChoose from "../../auth/SignupChoose";
import SignIn from "../../auth/SignIn";
import Signup from "../../auth/Signup";
import ToastContent from "../../helper/ToastContent";
import { withToastManager } from "react-toast-notifications";
import api from "../../../Environment";
import ForgotPassword from "../../auth/ForgotPassword";
import { Link } from "react-router-dom";
import Search from "./Search";
import GoogleLogin from "react-google-login";

import config from "react-global-configuration";
var const_time_zone = Intl.DateTimeFormat().resolvedOptions().timeZone;
const $ = window.$;

class Header extends Component {
  state = {
    signInType: null,
    signUpType: null,
    inputData: { timezone: const_time_zone },
    loadingContent: null,
    buttonDisable: false,
    searchInputData: {},
    searchData: null,
    loadingSearch: true,
    searchLoadingContent: null,
    notificationCountLoading: true,
    notificationCount: null,
    notificationData: null,
    loadingNotification: true,
    profileData: {},
  };
  componentDidMount() {
    this.getNotificationCount();
  }
  ChooseSignInType = (event, type) => {
    this.setState({ signInType: type });
    const inputData = { ...this.state.inputData };
    inputData["login_type"] = type;
    this.setState({ inputData });
  };

  ChooseSignUpType = (event, type) => {
    this.setState({ signUpType: type });
    const inputData = { ...this.state.inputData };
    inputData["login_type"] = type;
    this.setState({ inputData });
  };

  handleChange = ({ currentTarget: input }) => {
    const inputData = { ...this.state.inputData };
    inputData[input.name] = input.value;
    this.setState({ inputData });
  };

  forgotPasswordClicked = () => {
    // close login model.
    $("#signin-streamer").modal("hide");
  };

  handleLogin = (event) => {
    event.preventDefault();
    const path = this.props.location;
    this.setState({
      loadingContent: "Loading...",
      buttonDisable: true,
    });
    api
      .postMethod("login", this.state.inputData)
      .then((response) => {
        if (response.data.success) {
          localStorage.setItem("userId", response.data.data.user_id);
          localStorage.setItem("accessToken", response.data.data.token);
          localStorage.setItem("userLoginStatus", true);
          localStorage.setItem("user_picture", response.data.data.picture);
          localStorage.setItem(
            "isStreamer",
            response.data.data.is_content_creator
          );
          localStorage.setItem("username", response.data.data.name);
          localStorage.setItem(
            "total_followers",
            response.data.data.total_followers
          );
          localStorage.setItem(
            "total_followings",
            response.data.data.total_followings
          );
          localStorage.setItem(
            "total_live_videos",
            response.data.data.total_live_videos
          );

          ToastContent(
            this.props.toastManager,
            response.data.message,
            "success"
          );
          this.setState({
            loadingContent: null,
            buttonDisable: false,
          });
          $("#signin-streamer").modal("hide");
          if (path) {
            this.props.history.push(path.pathname);
          } else {
            this.props.history.push("/");
          }
        } else {
          this.setState({
            loadingContent: null,
            buttonDisable: false,
          });
          ToastContent(this.props.toastManager, response.data.error, "error");
        }
      })
      .catch((error) => {
        this.setState({ loadingContent: null, buttonDisable: false });
      });
  };

  handleSignup = (event) => {
    event.preventDefault();
    const path = this.props.location;
    this.setState({
      loadingContent: "Loading...",
      buttonDisable: true,
    });
    api
      .postMethod("register", this.state.inputData)
      .then((response) => {
        if (response.data.success) {
          localStorage.setItem("userId", response.data.data.user_id);
          localStorage.setItem("accessToken", response.data.data.token);
          localStorage.setItem("userLoginStatus", true);
          localStorage.setItem("user_picture", response.data.data.picture);
          localStorage.setItem("username", response.data.data.name);
          localStorage.setItem(
            "isStreamer",
            response.data.data.is_content_creator
          );
          localStorage.setItem(
            "total_followers",
            response.data.data.total_followers
          );
          localStorage.setItem(
            "total_followings",
            response.data.data.total_followings
          );
          localStorage.setItem(
            "total_live_videos",
            response.data.data.total_live_videos
          );

          ToastContent(
            this.props.toastManager,
            response.data.message,
            "success"
          );
          this.setState({
            loadingContent: null,
            buttonDisable: false,
          });
          $("#signup-streamer").modal("hide");

          if (path) {
            this.props.history.push(path.pathname);
          } else {
            this.props.history.push("/");
          }
        } else {
          ToastContent(this.props.toastManager, response.data.error, "error");
          if (
            response.data.error_code == 1001 ||
            response.data.error_code == 1000
          ) {
            $("#signup-streamer").modal("hide");
          }
          this.setState({
            loadingContent: null,
            buttonDisable: false,
          });
        }
      })
      .catch(function (error) {});
  };

  handleGoogleResponse = (event) => {
    console.log("handleGoogleResponse", event);
    const { path } = this.props.location;
    const response = event.profileObj;
    if (response) {
      this.setState({
        loadingContent: "Loading...",
        buttonDisable: true,
      });

      const googleInputData = {
        social_unique_id: response.googleId,
        login_by: "google",
        email: response.email,
        name: response.name,
        picture: response.imageUrl,
        device_type: "web",
        device_token: "123466",
        timezone: const_time_zone,
        login_type: this.state.inputData.login_type,
      };

      api
        .postMethod("register", googleInputData)
        .then((response) => {
          if (response.data.success) {
            localStorage.setItem("userId", response.data.data.user_id);
            localStorage.setItem("accessToken", response.data.data.token);
            localStorage.setItem("userLoginStatus", true);
            localStorage.setItem(
              "isStreamer",
              response.data.data.is_content_creator
            );
            localStorage.setItem("user_picture", response.data.data.picture);
            localStorage.setItem("username", response.data.data.name);
            localStorage.setItem(
              "total_followers",
              response.data.data.total_followers
            );
            localStorage.setItem(
              "total_followings",
              response.data.data.total_followings
            );
            localStorage.setItem(
              "total_live_videos",
              response.data.data.total_live_videos
            );

            ToastContent(
              this.props.toastManager,
              response.data.message,
              "success"
            );
            this.setState({
              loadingContent: null,
              buttonDisable: false,
            });

            $("#signup-streamer").modal("hide");
            $("#signin-streamer").modal("hide");

            if (path) {
              this.props.history.push(path.pathname);
            } else {
              this.props.history.push("/");
            }
          } else {
            ToastContent(this.props.toastManager, response.data.error, "error");
            if (
              response.data.error_code == 1001 ||
              response.data.error_code == 1000
            ) {
              $("#signup-streamer").modal("hide");
              $("#signin-streamer").modal("hide");
            }
            this.setState({
              loadingContent: null,
              buttonDisable: false,
            });
          }
        })
        .catch(function (error) {});
    }
  };

  handleForgotPassword = (event) => {
    event.preventDefault();
    const path = this.props.location;

    this.setState({
      loadingContent: "Loading...",
      buttonDisable: true,
    });
    api
      .postMethod("forgot_password", this.state.inputData)
      .then((response) => {
        if (response.data.success) {
          ToastContent(
            this.props.toastManager,
            response.data.message,
            "success"
          );
          this.setState({
            loadingContent: null,
            buttonDisable: false,
          });
          $("#forgot-password-stremer").modal("hide");

          if (path) {
            this.props.history.push(path.pathname);
          } else {
            this.props.history.push("/");
          }
        } else {
          ToastContent(this.props.toastManager, response.data.error, "error");
          if (
            response.data.error_code == 1001 ||
            response.data.error_code == 1000
          ) {
            $("#forgot-password-stremer").modal("hide");
          }
          this.setState({
            loadingContent: null,
            buttonDisable: false,
          });
        }
      })
      .catch(function (error) {});
  };

  handleSearchChange = ({ currentTarget: input }) => {
    this.setState({ searchLoadingContent: "Loading..." });
    const searchInputData = { ...this.state.searchInputData };
    searchInputData[input.name] = input.value;
    this.setState({ searchInputData });
    setTimeout(() => {
      if (this.state.searchInputData.key.length > 0) {
        this.searchAPI();
      } else {
        this.setState({
          searchData: null,
          loadingSearch: true,
          searchLoadingContent: null,
        });
      }
    }, 1000);
  };

  searchAPI = () => {
    api
      .postMethod("users_search", this.state.searchInputData)
      .then((response) => {
        if (response.data.success) {
          this.setState({
            searchData: response.data.data,
            loadingSearch: false,
            searchLoadingContent: null,
          });
        } else {
        }
      });
  };

  clearSearchData = () => {
    this.setState({
      searchData: null,
      loadingSearch: true,
      searchLoadingContent: null,
    });
  };

  getNotificationCount = () => {
    api.postMethod("bell_notifications_count").then((response) => {
      if (response.data.success) {
        this.setState({
          notificationCount: response.data.data.count,
          notificationCountLoading: false,
        });
      } else {
      }
    });
  };

  getNotificationDetails = () => {
    if (this.state.notificationData == null) {
      this.getNotificationAPI();
    }
  };

  getNotificationAPI = () => {
    api.postMethod("bell_notifications").then((response) => {
      if (response.data.success) {
        this.setState({
          notificationData: response.data.data,
          loadingNotification: false,
        });
      } else {
      }
    });
  };

  render() {
    const {
      signInType,
      signUpType,
      loadingContent,
      buttonDisable,
      inputData,
      searchInputData,
      searchData,
      loadingSearch,
      searchLoadingContent,
      notificationCount,
      notificationCountLoading,
      notificationData,
      loadingNotification,
    } = this.state;
    return (
      <>
        <header>
          <nav className="navbar navbar-default navbar-fixed-top">
            <div>
              <div className="navbar-header">
                <button
                  type="button"
                  className="navbar-toggle collapsed"
                  data-toggle="collapse"
                  data-target="#bs-example-navbar-collapse-1"
                  aria-expanded="false"
                >
                  <span className="fa fa-bars"></span>
                </button>
                <Link className="navbar-brand logo" to={"/"}>
                  <img
                    src={config.get("configData.site_icon")}
                    className="logo-img"
                  />
                </Link>
              </div>

              <div
                className="collapse navbar-collapse text-center"
                id="bs-example-navbar-collapse-1"
              >
                <Search
                  handleSearchChange={this.handleSearchChange}
                  loadingSearch={loadingSearch}
                  searchInputData={searchInputData}
                  searchData={searchData}
                  searchLoadingContent={searchLoadingContent}
                  clearSearchData={this.clearSearchData}
                />

                <ul className="nav navbar-nav  notification-bell navbar-right hidden-xs resp-left ">
                  {localStorage.getItem("userLoginStatus") ? (
                    <>
                      <Notification
                        notificationCountLoading={notificationCountLoading}
                        notificationCount={notificationCount}
                        getNotificationDetails={this.getNotificationDetails}
                        loadingNotification={loadingNotification}
                        notificationData={notificationData}
                      />
                      <li>
                        <Link to={"/account"}>
                          <img
                            src={localStorage.getItem("user_picture")}
                            className="user-img"
                          />
                        </Link>
                      </li>
                    </>
                  ) : (
                    <>
                      <SignInChoose
                        ChooseSignInType={this.ChooseSignInType}
                        signInType={signInType}
                      />

                      <SignupChoose
                        ChooseSignUpType={this.ChooseSignUpType}
                        signUpType={signUpType}
                      />
                    </>
                  )}
                  {/* {this.props.location.pathname === "/" &&
                  localStorage.getItem("userLoginStatus") ? (
                    <a href="#" className="slidebar-icon">
                      <img
                        src={window.location.origin + "/assets/img/menu.png"}
                      />
                    </a>
                  ) : null} */}
                </ul>
              </div>
            </div>
          </nav>
        </header>
        <SignIn
          signInType={signInType}
          inputData={inputData}
          handleLogin={this.handleLogin}
          loadingContent={loadingContent}
          buttonDisable={buttonDisable}
          handleChange={this.handleChange}
          forgotPasswordClicked={this.forgotPasswordClicked}
          handleGoogleResponse={this.handleGoogleResponse}
        />
        <Signup
          signUpType={signUpType}
          inputData={inputData}
          handleSignup={this.handleSignup}
          loadingContent={loadingContent}
          buttonDisable={buttonDisable}
          handleChange={this.handleChange}
        />
        <ForgotPassword
          signInType={signInType}
          inputData={inputData}
          handleForgotPassword={this.handleForgotPassword}
          loadingContent={loadingContent}
          buttonDisable={buttonDisable}
          handleChange={this.handleChange}
        />
      </>
    );
  }
}

export default withToastManager(Header);
