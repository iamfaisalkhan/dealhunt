package com.bby.lsh;

import java.io.IOException;
import java.io.Reader;
import java.io.StringReader;
import java.lang.reflect.Array;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.HashSet;
import java.util.Iterator;
import java.util.Random;

import org.apache.lucene.analysis.TokenStream;
import org.apache.lucene.analysis.ngram.NGramTokenizer;
import org.apache.lucene.analysis.shingle.ShingleFilter;
import org.apache.lucene.analysis.standard.StandardTokenizer;
import org.apache.lucene.analysis.tokenattributes.CharTermAttribute;
import org.apache.lucene.util.Version;

import com.bby.rollinghash.CyclicHash;

public class MinHash {
   
   private static final int numHashFunctions = 100;
   // Hash values for 
   private int[] minHashValues = null;
   // arrays for generating hash functions
   private int[] a;
   private int[] b;
   private int[] c;
   private int universeSize = 0;
   
   private HashMap<String, Integer> elements = new 
         HashMap<String, Integer>();
   
     public MinHash(int universeSize) {
      a = new int[numHashFunctions];
      b = new int[numHashFunctions];
      c = new int[numHashFunctions];
      this.universeSize = universeSize;
      
      Random r = new Random(11);
      for (int i = 0; i < numHashFunctions; i++) {
         a[i] = r.nextInt(universeSize);
         b[i] = r.nextInt(universeSize);
         c[i] = r.nextInt(universeSize);
      }
   }
   
   public void computeMinHash(ArrayList<HashSet<Integer>> data,
         HashMap<Integer, Integer> elements) {
      
      // TODO: min-hash values array is going to be greatly sparse, we are going
      // TODO: to exploit this fact. 
      minHashValues = new int[numHashFunctions * data.size()];
      Arrays.fill(minHashValues, Integer.MAX_VALUE);
      
      int setIndex = 0;
      for (HashSet<Integer> item : data) {
         Iterator<Integer> indices = item.iterator();
         while (indices.hasNext()) {
            int index = indices.next();
            for (int i = 0; i < numHashFunctions; i++) {
               int hindex = applyHashFunction(i, index);
               
               if (hindex < minHashValues[setIndex + i])
                  minHashValues[setIndex + i] = hindex;
            }
            
         }
         // The min-hash matrix has N rows and M columns, where N is 
         // equal to number of hash functions and M represents total number
         // of elements (e.g. tokens) in data. 
         setIndex += numHashFunctions;
      }
      
      computeSimilarity();
      
   }
   
   private void computeSimilarity() {
      int data = minHashValues.length / numHashFunctions;
      System.out.println("Data length " + data);
      
      for (int i = 0; i < data; i++) {
         for (int j = i+1; j < data; j++) {
            int matches = 0;
            System.out.println("Comparing " + i + " " + j);
            for (int m = 0; m < numHashFunctions; m++) {
               if (minHashValues[(i*numHashFunctions) + m] == 
                     minHashValues[(j*numHashFunctions) + m])
                  matches++;
            }
            
            double res = (1.0 * matches) / (double) numHashFunctions;
            
            System.out.println( "Result " + res);
         }
      }
      
   }
   
   private int applyHashFunction(int funcIndex, int index) {
      if (funcIndex > numHashFunctions) return -1;
      
      
      int hashValue = (a[funcIndex] * index + 
                      b[funcIndex] +  c[funcIndex] ) %
                      universeSize;
      
      return hashValue;
   }
   
   public static void main(String args[]) {
      String test1 = "Someone stole my coffee, Is that you?";
      String test2 = "Someone my coffee, Is that you";
      String test3  = "There are so many pigs in this farm";
      String test1b = "Someone stole coffee, Is that you";
      String test4 = "A completly unrelated one";
      String test5 = "A completly unrelated";

      
      String data[] = {test5, test1, test2, test3, test1b, test4};
      
      for (int i = 0; i < data.length; i++) data[i] = data[i].replaceAll("\\s", "");

      HashMap<Integer, Integer> elements = new HashMap<Integer, Integer>();
      ArrayList<HashSet<Integer>> data2 = new ArrayList<HashSet<Integer>>();
      int n = 9;
      CyclicHash ch = new CyclicHash(n);

      HashSet<Integer> datarow;
      int tknNo = 0;
      
      for (String d : data) {
         datarow = new HashSet<Integer>();
         
         try {
            int k = 0;
            int rollinghash = 0;
   
            // eat initial few characters. 
            for(; k < n - 1; ++k) {
               ch.eat(d.charAt(k));
            }
            rollinghash = ch.eat(d.charAt(k++));
            
            if (! elements.containsKey(rollinghash)) {
               elements.put(rollinghash, tknNo);
               datarow.add(tknNo);
               // Increment token number for each unique token only. 
               ++tknNo; 
            } else {
               datarow.add(elements.get(rollinghash));
            }


            for (; k < d.length(); ++k) {
               rollinghash = ch.update(d.charAt(k-n), d.charAt(k));
               
               if (! elements.containsKey(rollinghash)) {
                  elements.put(rollinghash, tknNo);
                  datarow.add(tknNo);
                  // Increment token number for each unique token only. 
                  ++tknNo; 
               } else {
                  datarow.add(elements.get(rollinghash));
               }

            }
            
            data2.add(datarow);

            k = 0;
            ch.reset();

         } catch (IndexOutOfBoundsException ie) {
            
         }
      }

      // Calling MinHash
      MinHash minhash = new MinHash(elements.size());
      minhash.computeMinHash(data2, elements);
   }

}
