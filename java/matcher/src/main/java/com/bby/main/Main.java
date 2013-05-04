package com.bby.main;

import java.util.HashMap;

import com.bby.config.TranslationConfiguration;

public class Main {
   public static void main(String args[]) {
      TranslationConfiguration config = TranslationConfiguration.getInstance();
      HashMap<String, String> map = config.getTranslationMap("deals2buy");
   }
   
}
