package com.bby.pipeline;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.FilenameFilter;
import java.io.IOException;
import java.util.HashMap;
import java.util.logging.Logger;

import org.json.simple.JSONObject;
import org.json.simple.parser.JSONParser;

import com.bby.config.AppConfiguration;
import com.bby.config.TranslationConfiguration;
/**
 * Read a file from the source location, do something
 *   with it and pass it along to the next step in the pipeline.
 * 
 * @author faisal
 *
 */
public class DealFileSource {

   private static final Logger logger = Logger.getLogger(DealFileSource.class.getName());
   
   private DealPersistance persist = null;
   
   // Parser object used for decoding JSON values.
   private JSONParser jsonParser = null;
   
   public DealFileSource() {
      persist = new DealPersistance();
      jsonParser = new JSONParser();
      process();
   }

   private void process() {      
      AppConfiguration appConfig = AppConfiguration.getInstance();

      String path = appConfig.getProperty("deals.path");
      File f = new File(path);
      String[] files = null;
      
      if (f.isDirectory()) {
         files = f.list(new JSONFileFilter());
         
      } else {
         files = new String[1];
         files[0] = path;
      }
      
      if (files == null) return;
      
      for (String file: files) {
         processFile(path, file);
      }
    
   }
   
   private void processFile(String path, String file) {
      TranslationConfiguration translate = TranslationConfiguration.getInstance();
      Deal d = new Deal();

      BufferedReader buffIn = null;
      try {
         // Load the file
         File dealFile = new File(path + File.separator + file);
         // Extract crawl source from the file name
         String source = file.split("\\.")[0];
         logger.info("Processing file at " + dealFile.getAbsolutePath());
         logger.info("Source from the file : " + source);
         d.setCrawlSource(source);
         buffIn = new BufferedReader(new FileReader(dealFile));
         String inLine = null;
         // Each line is a JSON entry
         while ( (inLine = buffIn.readLine()) != null) {
            logger.finest(inLine);
            JSONObject obj = (JSONObject) jsonParser.parse(inLine);
            HashMap<String, String> mapping = translate.getTranslationMap(source);
            String localKey = "";
            for (String s: mapping.keySet()) {
               try {
                  // TODO Don't use hard-coded keys
                  localKey = mapping.get(s);
                  if (localKey.equalsIgnoreCase("title")) 
                     d.setTitle((String)obj.get(s));
                  if (localKey.equalsIgnoreCase("date_added"))
                     d.setDateAdded((String)obj.get(s));
                  if (localKey.equalsIgnoreCase("source"))
                     d.setDealSource((String)obj.get(s));
                  if (localKey.equalsIgnoreCase("date_expires"))
                     d.setDateExpires((String)obj.get(s));
                  
                  // TODO: add deal price
                  // TODO: add deal list price
               } catch (Exception ex) {
                  //TODO: put debug statement
                  ex.printStackTrace();
               } finally {}
            }
            persist.save(d);
         }
      } catch (Exception e) {
         e.printStackTrace();
      } finally {
         try {
            buffIn.close();
         } catch (IOException e) {}
      }
   }
   
   class JSONFileFilter implements FilenameFilter {

      public boolean accept(File dir, String name) {
         if (name.toString().endsWith(".json")) return true;
         return false;
      }
   }
   
}

