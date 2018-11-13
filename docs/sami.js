
window.projectVersion = 'master';

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:Aboldyrev" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Aboldyrev.html">Aboldyrev</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Aboldyrev_Cache" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Aboldyrev/Cache.html">Cache</a>                    </div>                </li>                            <li data-name="class:Aboldyrev_Proxy" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Aboldyrev/Proxy.html">Proxy</a>                    </div>                </li>                            <li data-name="class:Aboldyrev_WebClient" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Aboldyrev/WebClient.html">WebClient</a>                    </div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "Aboldyrev.html", "name": "Aboldyrev", "doc": "Namespace Aboldyrev"},
            
            {"type": "Class", "fromName": "Aboldyrev", "fromLink": "Aboldyrev.html", "link": "Aboldyrev/Cache.html", "name": "Aboldyrev\\Cache", "doc": "&quot;\u041a\u043b\u0430\u0441\u0441 \u0434\u043b\u044f \u0440\u0430\u0431\u043e\u0442\u044b \u0441 \u043a\u0435\u0448\u0435\u043c&quot;"},
                                                        {"type": "Method", "fromName": "Aboldyrev\\Cache", "fromLink": "Aboldyrev/Cache.html", "link": "Aboldyrev/Cache.html#method___construct", "name": "Aboldyrev\\Cache::__construct", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\Cache", "fromLink": "Aboldyrev/Cache.html", "link": "Aboldyrev/Cache.html#method_isEmptyCache", "name": "Aboldyrev\\Cache::isEmptyCache", "doc": "&quot;\u041f\u0440\u043e\u0432\u0435\u0440\u044f\u0435\u0442 \u043f\u0443\u0441\u0442\u043e\u0439 \u043b\u0438 \u043a\u0435\u0448&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\Cache", "fromLink": "Aboldyrev/Cache.html", "link": "Aboldyrev/Cache.html#method_checkMimeType", "name": "Aboldyrev\\Cache::checkMimeType", "doc": "&quot;\u041f\u0440\u043e\u0432\u0435\u0440\u044f\u0435\u0442 mime-type \u0437\u0430\u043a\u0435\u0448\u0438\u0440\u043e\u0432\u0430\u043d\u043d\u043e\u0433\u043e \u0444\u0430\u0439\u043b\u0430&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\Cache", "fromLink": "Aboldyrev/Cache.html", "link": "Aboldyrev/Cache.html#method_checkDate", "name": "Aboldyrev\\Cache::checkDate", "doc": "&quot;\u041c\u0435\u0442\u043e\u0434 \u0434\u043b\u044f \u043f\u0440\u043e\u0432\u0435\u0440\u043a\u0438 \u0443\u0441\u0442\u0430\u0440\u0435\u043b \u043b\u0438 \u043a\u0435\u0448 \u0444\u0430\u0439\u043b\u0430 \u0438\u043b\u0438 \u043d\u0435\u0442&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\Cache", "fromLink": "Aboldyrev/Cache.html", "link": "Aboldyrev/Cache.html#method_check", "name": "Aboldyrev\\Cache::check", "doc": "&quot;\u041f\u0440\u043e\u0432\u0435\u0440\u044f\u0435\u0442 \u0441\u0443\u0449\u0435\u0441\u0442\u0432\u0443\u0435\u0442 \u043b\u0438 \u043a\u0435\u0448 \u043e\u043f\u0440\u0435\u0434\u0435\u043b\u0435\u043d\u043d\u043e\u0433\u043e \u0437\u0430\u043f\u0440\u043e\u0441\u0430&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\Cache", "fromLink": "Aboldyrev/Cache.html", "link": "Aboldyrev/Cache.html#method_get", "name": "Aboldyrev\\Cache::get", "doc": "&quot;\u0412\u043e\u0437\u0432\u0440\u0430\u0449\u0430\u0435\u0442 \u0441\u043e\u0434\u0435\u0440\u0436\u0438\u043c\u043e\u0435 \u043a\u0435\u0448\u0430&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\Cache", "fromLink": "Aboldyrev/Cache.html", "link": "Aboldyrev/Cache.html#method_put", "name": "Aboldyrev\\Cache::put", "doc": "&quot;\u041a\u0435\u0448\u0438\u0440\u0443\u0435\u0442 \u0434\u0430\u043d\u043d\u044b\u0435&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\Cache", "fromLink": "Aboldyrev/Cache.html", "link": "Aboldyrev/Cache.html#method_cache", "name": "Aboldyrev\\Cache::cache", "doc": "&quot;\u0421\u043e\u0445\u0440\u0430\u043d\u044f\u0435\u0442 \u0438\u043b\u0438 \u0432\u043e\u0437\u0432\u0440\u0430\u0449\u0430\u0435\u0442 \u043a\u0435\u0448\u0438\u0440\u043e\u0432\u0430\u043d\u043d\u044b\u0435 \u0434\u0430\u043d\u043d\u044b\u0435&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\Cache", "fromLink": "Aboldyrev/Cache.html", "link": "Aboldyrev/Cache.html#method_forget", "name": "Aboldyrev\\Cache::forget", "doc": "&quot;\u0423\u0434\u0430\u043b\u044f\u0435\u0442 \u0438\u0437 \u043a\u0435\u0448\u0430 \u0444\u0430\u0439\u043b, \u043f\u0430\u043f\u043a\u0443 \u0438\u043b\u0438 \u043f\u043e\u043b\u043d\u043e\u0441\u0442\u044c\u044e \u0432\u0435\u0441\u044c \u043a\u0435\u0448&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\Cache", "fromLink": "Aboldyrev/Cache.html", "link": "Aboldyrev/Cache.html#method_getPath", "name": "Aboldyrev\\Cache::getPath", "doc": "&quot;\u0412\u043e\u0437\u0432\u0440\u0430\u0449\u0430\u0435\u0442 \u043f\u0443\u0442\u044c \u0434\u043e \u0444\u0430\u0439\u043b\u0430 \u043d\u0430 \u043e\u0441\u043d\u043e\u0432\u0435 URL&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\Cache", "fromLink": "Aboldyrev/Cache.html", "link": "Aboldyrev/Cache.html#method_getSiteName", "name": "Aboldyrev\\Cache::getSiteName", "doc": "&quot;\u0412\u043e\u0437\u0432\u0440\u0430\u0449\u0430\u0435\u0442 \u043d\u0430\u0437\u0432\u0430\u043d\u0438\u0435 \u0441\u0430\u0439\u0442\u0430 (\u0434\u043e\u043c\u0435\u043d)&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\Cache", "fromLink": "Aboldyrev/Cache.html", "link": "Aboldyrev/Cache.html#method_getHost", "name": "Aboldyrev\\Cache::getHost", "doc": "&quot;\u041f\u043e\u043b\u0443\u0447\u0438\u0442\u044c \u0445\u043e\u0441\u0442 \u0438\u0437 URL&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\Cache", "fromLink": "Aboldyrev/Cache.html", "link": "Aboldyrev/Cache.html#method_getFilename", "name": "Aboldyrev\\Cache::getFilename", "doc": "&quot;\u0412\u043e\u0437\u0432\u0440\u0430\u0449\u0430\u0435\u0442 \u043d\u0430\u0437\u0432\u0430\u043d\u0438\u0435 \u0444\u0430\u0439\u043b\u0430 \u043d\u0430 \u043e\u0441\u043d\u043e\u0432\u0435 URL&quot;"},
            
            {"type": "Class", "fromName": "Aboldyrev", "fromLink": "Aboldyrev.html", "link": "Aboldyrev/Proxy.html", "name": "Aboldyrev\\Proxy", "doc": "&quot;\u041a\u043b\u0430\u0441\u0441 \u043f\u0440\u043e\u043a\u0441\u0438&quot;"},
                                                        {"type": "Method", "fromName": "Aboldyrev\\Proxy", "fromLink": "Aboldyrev/Proxy.html", "link": "Aboldyrev/Proxy.html#method_create", "name": "Aboldyrev\\Proxy::create", "doc": "&quot;\u0421\u043e\u0437\u0434\u0430\u043d\u0438\u0435 \u043e\u0431\u044a\u0435\u043a\u0442\u0430 \u043f\u0440\u043e\u043a\u0441\u0438&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\Proxy", "fromLink": "Aboldyrev/Proxy.html", "link": "Aboldyrev/Proxy.html#method_get", "name": "Aboldyrev\\Proxy::get", "doc": "&quot;\u041f\u043e\u043b\u0443\u0447\u0438\u0442\u044c \u043f\u0440\u043e\u043a\u0441\u0438 \u0432 \u0432\u0438\u0434\u0435 \u0441\u0442\u0440\u043e\u043a\u0438&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\Proxy", "fromLink": "Aboldyrev/Proxy.html", "link": "Aboldyrev/Proxy.html#method_setAccount", "name": "Aboldyrev\\Proxy::setAccount", "doc": "&quot;\u0420\u0430\u0437\u0431\u0438\u0432\u0430\u0435\u0442 \u0441\u0442\u0440\u043e\u043a\u0443 \u0441 \u043b\u043e\u0433\u0438\u043d\u043e\u043c \u0438 \u043f\u0430\u0440\u043e\u043b\u0435\u043c \u0432 \u043c\u0430\u0441\u0441\u0438\u0432&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\Proxy", "fromLink": "Aboldyrev/Proxy.html", "link": "Aboldyrev/Proxy.html#method_setAddress", "name": "Aboldyrev\\Proxy::setAddress", "doc": "&quot;\u0420\u0430\u0437\u0431\u0438\u0432\u0430\u0435\u0442 \u0441\u0442\u0440\u043e\u043a\u0443 \u0441 \u0445\u043e\u0441\u0442\u043e\u043c \u0438 \u043f\u043e\u0440\u0442\u043e\u043c \u043d\u0430 \u0441\u0442\u0440\u043e\u043a\u0443&quot;"},
            
            {"type": "Class", "fromName": "Aboldyrev", "fromLink": "Aboldyrev.html", "link": "Aboldyrev/WebClient.html", "name": "Aboldyrev\\WebClient", "doc": "&quot;\u041a\u043b\u0430\u0441\u0441 \u043a\u043b\u0438\u0435\u043d\u0442\u0430&quot;"},
                                                        {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_create", "name": "Aboldyrev\\WebClient::create", "doc": "&quot;\u0421\u043e\u0437\u0434\u0430\u043d\u0438\u0435 \u043e\u0431\u044a\u0435\u043a\u0442\u0430 \u043a\u043b\u0438\u0435\u043d\u0442\u0430&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_setTimeout", "name": "Aboldyrev\\WebClient::setTimeout", "doc": "&quot;\u0423\u0441\u0442\u0430\u043d\u0430\u0432\u043b\u0438\u0432\u0430\u0435\u0442 \u0432\u0440\u0435\u043c\u044f \u043e\u0436\u0438\u0434\u0430\u043d\u0438\u044f \u043e\u0442\u0432\u0435\u0442\u0430&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_setTry", "name": "Aboldyrev\\WebClient::setTry", "doc": "&quot;\u0423\u0441\u0442\u0430\u043d\u0430\u0432\u043b\u0438\u0432\u0430\u0435\u0442 \u043a\u043e\u043b\u0438\u0447\u0435\u0441\u0442\u0432\u043e \u043f\u043e\u043f\u044b\u0442\u043e\u043a \u043e\u0442\u043f\u0440\u0430\u0432\u043a\u0438 \u0437\u0430\u043f\u0440\u043e\u0441\u0430&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_setUseProxy", "name": "Aboldyrev\\WebClient::setUseProxy", "doc": "&quot;\u0423\u0441\u0442\u0430\u043d\u0430\u0432\u043b\u0438\u0432\u0430\u0435\u0442 \u0444\u043b\u0430\u0433 \u0438\u0441\u043f\u043e\u043b\u044c\u0437\u043e\u0432\u0430\u043d\u0438\u044f \u043f\u0440\u043e\u043a\u0441\u0438&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_setProxies", "name": "Aboldyrev\\WebClient::setProxies", "doc": "&quot;\u041e\u0431\u043d\u043e\u0432\u043b\u044f\u0435\u0442 \u0441\u043f\u0438\u0441\u043e\u043a \u043f\u0440\u043e\u043a\u0441\u0438&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_setUserAgents", "name": "Aboldyrev\\WebClient::setUserAgents", "doc": "&quot;\u041e\u0431\u043d\u043e\u0432\u043b\u044f\u0435\u0442 \u0441\u043f\u0438\u0441\u043e\u043a user-agent&#039;\u043e\u0432&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_setUseWait", "name": "Aboldyrev\\WebClient::setUseWait", "doc": "&quot;\u0423\u0441\u0442\u0430\u043d\u0430\u0432\u043b\u0438\u0432\u0430\u0435\u0442 \u0444\u043b\u0430\u0433 \u0438\u0441\u043f\u043e\u043b\u044c\u0437\u043e\u0432\u0430\u043d\u0438\u044f \u0437\u0430\u0434\u0435\u0440\u0436\u043a\u0438 \u043f\u0435\u0440\u0435\u0434 \u0437\u0430\u043f\u0440\u043e\u0441\u043e\u043c&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_setWait", "name": "Aboldyrev\\WebClient::setWait", "doc": "&quot;\u0423\u0441\u0442\u0430\u043d\u0430\u0432\u043b\u0438\u0432\u0430\u0435\u0442 \u0432\u0440\u0435\u043c\u044f \u0437\u0430\u0434\u0435\u0440\u0436\u043a\u0438 \u043f\u0435\u0440\u0435\u0434 \u0437\u0430\u043f\u0440\u043e\u0441\u043e\u043c&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_setMethod", "name": "Aboldyrev\\WebClient::setMethod", "doc": "&quot;\u0423\u0441\u0442\u0430\u043d\u043e\u0432\u043a\u0430 \u043c\u0435\u0442\u043e\u0434\u0430 \u0437\u0430\u043f\u0440\u043e\u0441\u0430&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_setParams", "name": "Aboldyrev\\WebClient::setParams", "doc": "&quot;\u0423\u0441\u0442\u0430\u043d\u043e\u0432\u043a\u0430 \u043f\u0430\u0440\u0430\u043c\u0435\u0442\u0440\u043e\u0432 \u0437\u0430\u043f\u0440\u043e\u0441\u0430&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_updateProxy", "name": "Aboldyrev\\WebClient::updateProxy", "doc": "&quot;\u041e\u0431\u043d\u043e\u0432\u043b\u044f\u0435\u0442 \u0442\u0435\u043a\u0443\u0449\u0438\u0439 \u043f\u0440\u043e\u043a\u0441\u0438&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_updateUserAgent", "name": "Aboldyrev\\WebClient::updateUserAgent", "doc": "&quot;\u041e\u0431\u043d\u043e\u0432\u043b\u044f\u0435\u0442 \u0442\u0435\u043a\u0443\u0449\u0438\u0439 user-agent&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_getCache", "name": "Aboldyrev\\WebClient::getCache", "doc": "&quot;\u0412\u043e\u0437\u0432\u0440\u0430\u0449\u0430\u0435\u0442 \u043e\u0431\u044a\u0435\u043a\u0442 \u043a\u0435\u0448\u0430&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_getContent", "name": "Aboldyrev\\WebClient::getContent", "doc": "&quot;\u041f\u043e\u043b\u0443\u0447\u0438\u0442\u044c \u0441\u043e\u0434\u0435\u0440\u0436\u0438\u043c\u043e\u0435 URL&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_getFiles", "name": "Aboldyrev\\WebClient::getFiles", "doc": "&quot;\u0421\u043a\u0430\u0447\u0438\u0432\u0430\u043d\u0438\u0435 \u0441\u043f\u0438\u0441\u043a\u0430 \u0444\u0430\u0439\u043b\u043e\u0432&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_getFile", "name": "Aboldyrev\\WebClient::getFile", "doc": "&quot;\u0421\u043a\u0430\u0447\u0438\u0432\u0430\u043d\u0438\u0435 \u0444\u0430\u0439\u043b\u0430&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method___construct", "name": "Aboldyrev\\WebClient::__construct", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_getProxy", "name": "Aboldyrev\\WebClient::getProxy", "doc": "&quot;\u0412\u043e\u0437\u0432\u0440\u0430\u0449\u0430\u0435\u0442 \u0441\u043b\u0443\u0447\u0430\u0439\u043d\u044b\u0439 \u043f\u0440\u043e\u043a\u0441\u0438 \u0438\u0437 \u0441\u043f\u0438\u0441\u043a\u0430 \u0434\u043e\u0441\u0442\u0443\u043f\u043d\u044b\u0445&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_getUserAgent", "name": "Aboldyrev\\WebClient::getUserAgent", "doc": "&quot;\u0412\u043e\u0437\u0432\u0440\u0430\u0449\u0430\u0435\u0442 \u0441\u043b\u0443\u0447\u0430\u0439\u043d\u044b\u0439 user-agent \u0438\u0437 \u0441\u043f\u0438\u0441\u043a\u0430 \u0434\u043e\u0441\u0442\u0443\u043f\u043d\u044b\u0445. \u041d\u0443\u0436\u043d\u043e \u0434\u043b\u044f \u0438\u043c\u0438\u0442\u0430\u0446\u0438\u0438 \u0436\u0438\u0432\u044b\u0445 \u0437\u0430\u043f\u0440\u043e\u0441\u043e\u0432 \u0438 \u0441\u043d\u0438\u0436\u0435\u043d\u0438\u044f \u0432\u0435\u0440\u043e\u044f\u0442\u043d\u043e\u0441\u0442\u0438 \u0431\u043b\u043e\u043a\u0438\u0440\u043e\u0432\u043a\u0438&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_sendRequest", "name": "Aboldyrev\\WebClient::sendRequest", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Aboldyrev\\WebClient", "fromLink": "Aboldyrev/WebClient.html", "link": "Aboldyrev/WebClient.html#method_wait", "name": "Aboldyrev\\WebClient::wait", "doc": "&quot;\u0421\u0442\u0430\u0432\u0438\u0442 \u0437\u0430\u0434\u0435\u0440\u0436\u043a\u0443 \u043f\u0435\u0440\u0435\u0434 \u043e\u0442\u043f\u0440\u0430\u0432\u043a\u043e\u0439 \u0437\u0430\u043f\u0440\u043e\u0441\u0430 \u0435\u0441\u043b\u0438 \u044d\u0442\u043e \u043d\u0430\u0441\u0442\u0440\u043e\u0438\u043b\u0438. \u041d\u0435\u043e\u0431\u0445\u043e\u0434\u0438\u043c\u043e \u0434\u043b\u044f \u0438\u043c\u0438\u0442\u0430\u0446\u0438\u0438 \u0440\u0435\u0430\u043b\u044c\u043d\u044b\u0445 \u0437\u0430\u043f\u0440\u043e\u0441\u043e\u0432.&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


