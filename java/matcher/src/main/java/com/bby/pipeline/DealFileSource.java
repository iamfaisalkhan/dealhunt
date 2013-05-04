package com.bby.pipeline;

/**
 * Read a file from the source location, do something
 *   with it and pass it along to the next step in the pipeline.
 * 
 * @author faisal
 *
 */
public class DealFileSource {

   private String fileName = "";
   
   public DealFileSource(String file) {
      fileName = file;
   }

   private void init() {
      
   }
}

