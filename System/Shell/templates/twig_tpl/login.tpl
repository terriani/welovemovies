{# View gerada automaticamente Via Scooby_CLI em dateNow #}
<div class="bg-login">
    <div class="container z-depth-5" style="margin:3% auto !important; padding:0; background-color: #ddd !important">
    <a href="{{ base_url }}back" class="btn black">{{ btn_back }}</a>
        <h2 class="center">ScoobYTasks - Login</h2>
        {% if msg %}
            {{ msg|raw }}
        {% endif %}
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <form class="login-form  z-depth-5" method="post" action="{{ base_url }}make-login">
                    <div class="card">
                        <input type="hidden" name="csrfToken" value="{{ csrfToken }}">
                        <div class="card-content">
                            <div class="input-field">
                                <input class="validate" id="email" type="email" name="email">
                                <label for="email">Email</label>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="input-field">
                                        <input id="password" type="password" name="pass">
                                        <label for="password">Senha</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <div class="center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">{{ btn_sign_in }}
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col s4">
                        <a href="{{ base_url }}register" class="btn purple">{{ btn_sign_up }}</a>
                    </div>
                    <div class="col s8 right-align">
                        <a href="{{ base_url }}passwordRescue" class="btn red">{{ btn_password_reset }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
