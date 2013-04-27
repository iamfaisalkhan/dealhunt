package com.bby.json;

import java.io.FileReader;

import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import org.json.simple.parser.JSONParser;

public class JSONExample {
   public static void main(String[] args) {

      if (args.length < 1) {
         System.err.println("Usage: JSONExample <file>");
         return;
      }
      JSONParser parser = new JSONParser();

      try {
         JSONArray a = (JSONArray) parser.parse(new FileReader(args[0]));

         for (Object o : a) {
            JSONObject deal = (JSONObject) o;

            String title = (String) deal.get("title");
            System.out.println(title);
         }
      } catch (Exception e) {
         e.printStackTrace();
      }
   }
}
