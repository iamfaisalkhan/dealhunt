package com.bby.config;

import java.io.IOException;
import java.util.Properties;

public class AppConfiguration extends Properties {
   
   private static final long serialVersionUID = 1L;

   private static AppConfiguration config = null;
   
   private static final String APP_CONFIG = "app.config";
   
   public static AppConfiguration getInstance() {
      if (config == null) 
         config = new AppConfiguration();
      
      return config;
   }
   
   private AppConfiguration() {
      try {
         load(
            TranslationConfiguration.class.getClassLoader().getResourceAsStream(
               APP_CONFIG));
         
         for (String key :  stringPropertyNames()) {
            System.out.println(key + " => " + getProperty(key));
         }
         
      } catch (IOException ioe) {
      }
   }
}
