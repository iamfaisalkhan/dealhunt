package com.bby.lsh;

import java.util.Random;

public class MinHash {
   
   private static final int numHashFunctions = 100;
   private int[] hashFunctions;
   
   public MinHash(int universeSize) {
      hashFunctions = new int[numHashFunctions];
      Random r = new Random(11);
      for (int i = 0; i < numHashFunctions; i++) {
         int a = r.nextInt(universeSize);
         int b = r.nextInt(universeSize);
         int c = r.nextInt(universeSize);
         
         //hashFunctions[i] =
         
      }
   }
   
}
