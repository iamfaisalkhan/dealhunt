package com.bby.semantics3;

import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;

import org.scribe.builder.ServiceBuilder;
import org.scribe.builder.api.DefaultApi10a;
import org.scribe.model.OAuthRequest;
import org.scribe.model.Response;
import org.scribe.model.Token;
import org.scribe.model.Verb;
import org.scribe.oauth.OAuthService;

public class Semantics3Model {
    
    public static class TwoLeggedOAuth extends DefaultApi10a {
        @Override
        public String getAccessTokenEndpoint ()       { return ""; };
        @Override
        public String getRequestTokenEndpoint()       { return ""; };
        @Override
        public String getAuthorizationUrl(Token arg0) { return ""; };
    }
    
    public static void main(String args[]) {
        String SEMANTICS3_API_KEY = "SEM341A572DF804E42DB091C09240070C984";
        String SEMANTICS3_API_SECRET = "YzM5NzA2ZjY0MDkzMTU2N2FjMjM1NTg4MTZlMDljYTk";
        
        String URL = null;
        try {
            URL = "https://api.semantics3.com/v1/products?q={" + URLEncoder.encode("\"search\":\"Apple%2A\"", "UTF-8") + "}";
        } catch (UnsupportedEncodingException e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        }
        
        OAuthService service = new ServiceBuilder()
                                    .provider(TwoLeggedOAuth.class)
                                    .apiKey(SEMANTICS3_API_KEY)
                                    .apiSecret(SEMANTICS3_API_SECRET)
                                    .debug()
                                    .build();
        
        Token token = new Token("", "");
        OAuthRequest request = new OAuthRequest(Verb.GET, URL);
        service.signRequest(token, request);
        Response response = request.send();
        
        System.out.println(response.isSuccessful());
        System.out.println(response.getHeaders().toString());
        System.out.println(response.getBody());
    }
    
    
}
