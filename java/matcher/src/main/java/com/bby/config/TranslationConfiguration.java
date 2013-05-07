package com.bby.config;

import java.io.IOException;
import java.util.HashMap;
import java.util.Properties;
import java.util.logging.Logger;

public class TranslationConfiguration {
   
   // To implement singleton class. 
   private static TranslationConfiguration instance = null;

   // Logger 
   private static Logger logger = Logger.getLogger(TranslationConfiguration.class.toString());
   
   private Properties prop = new Properties();
   
   private static final String PROP_FILE = "deals_trans.config";
   
   // Prefix common to all properties
   private static final String PROP_COMMON_PREFIX = "com.bby.";
   
   public static TranslationConfiguration getInstance() {
      if (instance == null) {
         instance = new TranslationConfiguration();
      }
      
      return instance;
   }
   
   private TranslationConfiguration() {
      try {
         prop = new Properties();
         prop.load(
            TranslationConfiguration.class.getClassLoader().getResourceAsStream(
               PROP_FILE));
      } catch (IOException ioe) {
      }
   }
   
   /**
    * For a given deal source returns the appropriate translation between the deal
    * source and our database
    * 
    * @param dealSource - Name of the source
    * @return
    */
   public HashMap<String, String> getTranslationMap(String dealSource) {
      HashMap<String, String> translation = new HashMap<String, String>();
      
      for (String key : prop.stringPropertyNames()) {
         if (key.startsWith(dealSource)) {
            String[] tkns = key.split("\\.");
            if (tkns.length < 1) continue;
            translation.put(prop.getProperty(key), tkns[tkns.length-1]);
         }
      }
      
      return translation;
   }
   
}
